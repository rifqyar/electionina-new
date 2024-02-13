<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\KecamatanModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Helpers\GenerateNumberHelpers;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class KecamatanController extends Controller
{
    public function index()
    {
        $status = 1;
        $dapil =  DB::table('dapil')->select('dapil.id as dapilid','dapil.provinsi','dapil.kota_kabupaten')->get();
        $data = DB::table('kecamatan')
        ->join('dapil', 'dapil.id', '=', 'kecamatan.id_dapil')
        ->select('dapil.provinsi', 'dapil.kota_kabupaten','kecamatan.nama_kecamatan','kecamatan.id as idcamat','kecamatan.modified_by','kecamatan.updated_at')
        ->orderBy('kecamatan.updated_at', 'desc')
        ->get();
        return view('camat.index', compact('data','status','dapil'));
    }
    public function create(Request $request)
    {
        try {
            
            DB::beginTransaction();   
                
            KecamatanModel::create([
                'nama_kecamatan' => $request->camat,
                'id_dapil' => $request->iddapil,
                'created_by' => Auth::user()->name,
                'modified_by' => Auth::user()->name,
                'updated_at' => Carbon::now(),
                'created_at' =>Carbon::now(),
                'deletestatus' => 0,
            ]);
             
                DB::commit();
                return response()->json([
                    'url' => url('camat'),
                    'message' => 'Simpan Data Berhasil',
                    'status'=>200
                ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return response()->json([
                'url' => url('camat'),
                'message' => $th->getMessage(),
                'status'=>400
            ]);
        }
    }
    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            // Mendapatkan partai berdasarkan id
            $flight = PartaiModel::findOrFail($request->idpartaix);

            // Memeriksa dan mengupdate nama partai jika tidak null
            if ($request->namepartaix !== null) {
                $flight->name_partai = $request->namepartaix;
            }

            // Memeriksa dan mengupdate nomor partai jika tidak null
            if ($request->nomorpartaix !== null) {
                $flight->nomor_partai = $request->nomorpartaix;
            }

            // Memeriksa dan mengupdate alamat jika tidak null
            if ($request->alamatpartaix !== null) {
                $flight->alamat = $request->alamatpartaix;
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
                'url' => url('camat'),
                'message' => 'Update Data Berhasil'
            ]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi dan kembalikan pesan error
            DDB::rollBack();
            dd($th);
            return response()->json([
                'url' => url('camat'),
                'message' => "Gagal Update Data",
                'status'=>400
            ]);
        }
    }
}
