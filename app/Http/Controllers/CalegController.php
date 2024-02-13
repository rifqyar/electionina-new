<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\CalegModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Helpers\GenerateNumberHelpers;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class CalegController extends Controller
{
    public function index()
    {
        $status = 1;
        $dapil  =  DB::table('dapil')->select('dapil.provinsi','dapil.kota_kabupaten','dapil.id as iddapil')->get();
        $partai =  DB::table('partai')->select('partai.name_partai','partai.nomor_partai','partai.alamat','partai.id_partai as idpartai')->get();
        $data = DB::table('caleg')
        ->join('dapil', 'dapil.id', '=', 'caleg.id_dapil')
        ->join('partai', 'partai.id_partai', '=', 'caleg.id_partai')
        ->select('caleg.name_caleg', 'caleg.nomor_urut', 'caleg.alamat', 'dapil.provinsi', 'dapil.kota_kabupaten', 'partai.name_partai', 'partai.nomor_partai', 'caleg.id_caleg as idcaleg','caleg.modified_by','caleg.updated_at','partai.id_partai as idpartai')
        ->orderBy('caleg.updated_at', 'desc')
        ->get();

        return view('caleg.index', compact('data','status','dapil','partai'));
    }
    public function create(Request $request)
    {
        try {
            
            DB::beginTransaction();   
                
            CalegModel::create([
                'name_caleg' => $request->namecaleg,
                'id_partai' => $request->idpartai,
                'id_dapil' => $request->iddapil,
                'created_by' => Auth::user()->name,
                'modified_by' => Auth::user()->name,
                'updated_at' => Carbon::now(),
                'created_at' =>Carbon::now(),
                'deletestatus' => 0,
            ]);
             
                DB::commit();
                return response()->json([
                    'url' => url('caleg'),
                    'message' => 'Simpan Data Berhasil',
                    'status'=>200
                ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return response()->json([
                'url' => url('caleg'),
                'message' => $th->getMessage(),
                'status'=>400
            ]);
        }
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
        
            // Mendapatkan caleg berdasarkan id
            $id = $request->idcalegx;
            $flight = CalegModel::findOrFail($id);
        
            // Memeriksa dan mengupdate nama caleg jika tidak null
            if ($request->namecalegx !== null) {
                $flight->name_caleg = $request->namecalegx;
            }
        
            // Memeriksa dan mengupdate id partai jika tidak null
            if ($request->idpartaix !== null) {
                $flight->id_partai = $request->idpartaix;
            }
        
            // Memeriksa dan mengupdate id dapil jika tidak null
            if ($request->iddapilx !== null) {
                $flight->id_dapil = $request->iddapilx;
            }
        
            // Memeriksa dan mengupdate timestamp
            // $flight->created_by = Auth::user()->name;
            // $flight->modified_by = Auth::user()->name;
            // $flight->updated_at = Carbon::now();
        
            // Menyimpan perubahan
            $flight->save();
           
            // Commit transaksi
            DB::commit();
        
            // Kembalikan respons sukses
            return response()->json([
                'url' => url('caleg'),
                'message' => 'Update Data Berhasil'
            ]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi dan kembalikan pesan error
            DB::rollBack();
            dd($th);
            return response()->json([
                'url' => url('caleg'),
                'message' => "Gagal Update Data",
                'status'=>400
            ]);
        }
    }
}
