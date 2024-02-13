<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\PartaiModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Helpers\GenerateNumberHelpers;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class PartaiController extends Controller
{
    public function index()
    {
        $status = 1;
        $data=PartaiModel::where('deletestatus', 0)->get();
        return view('partai.index', compact('data','status'));
    }
    public function create(Request $request)
    {
        try {
            
            DB::beginTransaction();   
                
            PartaiModel::create([
                'name_partai' => $request->namepartai,
                'nomor_partai' => $request->nomorpartai,
                'alamat' => $request->alamatpartai,
                'created_by' => Auth::user()->name,
                'modified_by' => Auth::user()->name,
                'updated_at' => Carbon::now(),
                'created_at' =>Carbon::now(),
                'deletestatus' => 0,
            ]);
             
                DB::commit();
                return response()->json([
                    'url' => url('partai'),
                    'message' => 'Simpan Data Berhasil',
                    'status'=>200
                ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return response()->json([
                'url' => url('partai'),
                'message' => $th->getMessage(),
                'status'=>400
            ]);
        }
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
        
            // Mendapatkan partai berdasarkan id
            $id = $request->idpartaix;
            $flight = PartaiModel::findOrFail($id);
        
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
                'url' => url('partai'),
                'message' => 'Update Data Berhasil'
            ]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi dan kembalikan pesan error
            DB::rollBack();
            dd($th);
            return response()->json([
                'url' => url('partai'),
                'message' => "Gagal Update Data",
                'status'=>400
            ]);
        }
    }
}
