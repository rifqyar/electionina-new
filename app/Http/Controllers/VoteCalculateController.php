<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\DapilModel;
use App\Models\KecamatanModel;
use App\Models\DesaModel;
use App\Models\RtrwModel;
use App\Models\TpsModel;
use App\Models\User;
use App\Models\DetailDapilModel;
use App\Models\CalculateModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; 
class VoteCalculateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = 1;
        $partai =  DB::table('partai')->select('partai.name_partai','partai.nomor_partai','partai.alamat','partai.id_partai as idpartai')->get();
        $caleg =  DB::table('caleg')->select('caleg.id_caleg as id_caleg','caleg.name_caleg as name_caleg')->get();
        $dapil  =  DB::table('dapil')->select('dapil.provinsi','dapil.kota_kabupaten','dapil.id as iddapil')->get();
        $camat =  DB::table('kecamatan')->select('kecamatan.id as camatid','kecamatan.nama_kecamatan')->get();
        $desa =  DB::table('desa')->select('desa.id as desaid','desa.nama_desa')->get();
        $rtrw =  DB::table('rtrw')->select('rtrw.namertrw as namertrw','rtrw.id as idrtrw')->get();
        $tps =  DB::table('tps')->select('tps.id_tps as idtps','tps.name_tps as namatps')->get();
        
        
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
        ->selectRaw('i.name_partai,h.name_caleg,SUM(g.totalsuara_caleg) as total_suara,e.name_tps,c.nama_desa,b.nama_kecamatan')
        ->groupBy('i.name_partai','h.name_caleg','e.name_tps','c.nama_desa','b.nama_kecamatan');
        $results = $query->get();
        return view('vote.index', compact('results','status','partai','partai','caleg','dapil','camat','desa','rtrw','tps'));
    }
    public function getTpsByDesavote(Request $request)
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            
            DB::beginTransaction();   

            $detailDapil = DetailDapilModel::create([
                'id_user' => Auth::user()->id,
                'id_tps' => $request->selectTps,
                'id_desa' => $request->selectDesa,
                'id_kecamatan' => $request->camatx,
                'id_dapil' => $request->iddapil,
                'status_input' => 1,
            ]);
            
            $lastInsertedId = $detailDapil->id;
            
            CalculateModel::create([
                'id_dtl' =>  $lastInsertedId,
                'id_tps' => $request->selectTps,
                'id_user' => Auth::user()->id,
                'id_caleg' => $request->caleg,
                'totalsuara_caleg' => $request->suaracaleg,
            ]);
             
                DB::commit();
                return response()->json([
                    'url' => url('votecaleg'),
                    'message' => 'Simpan Data Berhasil',
                    'status'=>200
                ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return response()->json([
                'url' => url('votecaleg'),
                'message' => $th->getMessage(),
                'status'=>400
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
