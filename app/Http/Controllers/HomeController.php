<?php

namespace App\Http\Controllers;
use DateTime;
use App\Models\TpsModel;
use App\Models\User;
use App\Models\RtrwModel;
use App\Models\PartaiModel;
use App\Models\CalculateModel;
use App\Models\DetailDapilModel;
use App\Models\KecamatanModel;
use App\Models\DesaModel;
use App\Models\CalegModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Helpers\GenerateNumberHelpers;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; 
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $status = 1;
        $partai =  DB::table('partai')->select('partai.id_partai','partai.name_partai')->get();
        //$kecamatan =  DB::table('kecamatan')->select('kecamatan.id as idcamat','kecamatan.nama_kecamatan as namacamat')->get();
        $kecamatan =  DB::table('dapil as a')
        ->join('kecamatan as b', 'a.id', '=', 'b.id_dapil')
        ->select('b.id as idcamat','b.nama_kecamatan as namacamat','a.provinsi','a.kota_kabupaten')->get();
        $caleg =  DB::table('caleg')->select('caleg.id_caleg','caleg.name_caleg')->get();
        $data = DB::table('dapil as a')
                        ->join('kecamatan as b', 'a.id', '=', 'b.id_dapil')
                        ->join('desa as c', 'c.id_kecamatan', '=', 'b.id')
                        ->join('rtrw as d', 'd.id_desa', '=', 'c.id')
                        ->join('tps as e', 'e.id_rtrw', '=', 'd.id')
                        ->join('detail_dapil as f', 'f.id_tps', '=', 'e.id_tps')
                        ->join('calculate as g', 'g.id_dtl', '=', 'f.id_dtl')
                        ->join('caleg as h', 'h.id_caleg', '=', 'g.id_caleg') 
                        ->join('partai as i', 'i.id_partai', '=', 'h.id_partai') 
                        ->selectRaw('i.name_partai, SUM(g.totalsuara_caleg) as total_suara')
                        ->groupBy('i.name_partai')->get();

        $tps = DB::table('tps')
                        ->join('rtrw', 'tps.id_rtrw', '=', 'rtrw.id')
                        ->join('desa', 'desa.id', '=', 'rtrw.id_desa')
                        ->select('rtrw.id as idrtrw','tps.name_tps as name_tps','rtrw.rt','rtrw.rw')
                        ->orderBy('tps.updated_at', 'desc')
                        ->get();

        $desa = DB::table('desa')
        ->select('desa.id as iddesa','desa.nama_desa as namadesa')
        ->orderBy('desa.updated_at', 'desc')
        ->get();
        return view('home', compact('partai','kecamatan','desa','caleg','data','tps'));
        
    }
    public function getTpsByDesa(Request $request)
    {
        $iddesa = $request->input('iddesa');

        // Query untuk mendapatkan data TPS berdasarkan id desa
        $data = DB::table(function($query) use ($iddesa) {
            $query->select('rtrw.id as idrtrw','tps.name_tps as name_tps','rtrw.rt','rtrw.rw','tps.id_tps')
            ->from('tps')
            ->join('rtrw', 'rtrw.id', '=', 'tps.id_rtrw')
            ->join('desa', 'desa.id', '=', 'rtrw.id_desa')
            ->where('desa.id', $iddesa);
        })->get();

        return response()->json(['tps' => $data]);   
    }

    public function loadChartData(Request $request) {
        // Ambil data dari permintaan
            $selectedPartai = $request->input('partai_id');
            $selectedCamat = $request->input('kecamatan_id');
            $selectedDesa = $request->input('desa');
            $selectedTPS = $request->input('tps');
            $selectedCaleg = $request->input('caleg_id');

            // Mulai kueri
            $query = DB::table('dapil as a')
            ->join('kecamatan as b', 'a.id', '=', 'b.id_dapil')
            ->join('desa as c', 'c.id_kecamatan', '=', 'b.id')
            ->join('rtrw as d', 'd.id_desa', '=', 'c.id')
            ->join('tps as e', 'e.id_rtrw', '=', 'd.id')
            ->join('detail_dapil as f', 'f.id_tps', '=', 'e.id_tps')
            ->join('calculate as g', 'g.id_dtl', '=', 'f.id_dtl')
            ->join('caleg as h', 'h.id_caleg', '=', 'g.id_caleg') 
            ->join('partai as i', 'i.id_partai', '=', 'h.id_partai')
            // ->join('detail_dapil as h_detail', 'h_detail.id_kecamatan', '=', 'b.id')
            ->selectRaw('i.name_partai,h.name_caleg,SUM(g.totalsuara_caleg) as total_suara')
            ->groupBy('i.name_partai','h.name_caleg');
        
        // Filter berdasarkan pilihan pengguna
        if (!empty($selectedPartai)) {
            $query->where('i.id_partai', $selectedPartai); 
        }
        
        if (!empty($selectedCamat)) {
            $query->where('b.id', $selectedCamat); 
        }
        if (!empty($selectedDesa) && $selectedDesa !="square") {
            $query->where('c.id', $selectedDesa); 
        }
        if (!empty($selectedTPS) && $selectedTPS !="square") {
            $query->where('e.id_tps', $selectedTPS);
        }
        
        if (!empty($selectedCaleg) && $selectedCaleg !="square") {
            $query->where('h.id_caleg', $selectedCaleg); 
        }

            // Eksekusi kueri
            $results = $query->get();

            // Ubah hasil kueri menjadi format yang sesuai untuk Bar Chart
            $data = [];
            foreach ($results as $result) {
                if (!empty($selectedCaleg) && $selectedCaleg !="square") {
                    
                    $data['labels'][] =   $result->name_caleg . '-' . $result->name_partai;
                }
                else {
                    $data['labels'][] = $result->name_caleg . '-' . $result->name_partai;
                }
                
                $data['values'][] = $result->total_suara;
            }
           
            return response()->json(['data' => $data]);

    }
}
