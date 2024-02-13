<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\DesaModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Helpers\GenerateNumberHelpers;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class DesaController extends Controller
{
    public function index()
    {
        $status = 1;
        $camat =  DB::table('kecamatan')->select('kecamatan.id as camatid','kecamatan.nama_kecamatan')->get();
        $data = DB::table('desa')
        ->join('kecamatan', 'kecamatan.id', '=', 'desa.id_kecamatan')
        ->select('desa.nama_desa', 'kecamatan.nama_kecamatan', 'desa.id as iddesa','desa.modified_by','desa.updated_at','kecamatan.id as idcamat')
        ->orderBy('desa.updated_at', 'desc')
        ->get();
        return view('desa.index', compact('data','status','camat'));
    }
    public function create(Request $request)
    {
        try {
            
            DB::beginTransaction();   
                
            DesaModel::create([
                'nama_desa' => $request->camat,
                'id_kecamatan' => $request->iddapil,
                'created_by' => Auth::user()->name,
                'modified_by' => Auth::user()->name,
                'updated_at' => Carbon::now(),
                'created_at' =>Carbon::now(),
                'deletestatus' => 0,
            ]);
             
                DB::commit();
                return response()->json([
                    'url' => url('desa'),
                    'message' => 'Simpan Data Berhasil',
                    'status'=>200
                ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return response()->json([
                'url' => url('desa'),
                'message' => $th->getMessage(),
                'status'=>400
            ]);
        }
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
                $updateValues = [];
                
                if ($request->desanamex !== null) {
                    $updateValues['nama_desa'] = $request->desanamex;
                }

                if ($request->camatx !== null) {
                    $updateValues['id_kecamatan'] = $request->camatx;
                }
                if (!empty($updateValues)) {
                    DesaModel::where('id', $request->iddesax)->update($updateValues);
                }
                
                // Commit transaksi dan kembalikan respons
                DB::commit();
                return response()->json([
                    'url' => url('desa'),
                    'message' => 'Update Data Berhasil',
                    'status' => 200
                ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return response()->json([
                'url' => url('desa'),
                'message' => "Gagal Update Data",
                'status'=>400
            ]);
        }
    }
}
