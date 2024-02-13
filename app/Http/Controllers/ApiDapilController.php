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
class ApiDapilController extends Controller
{
 

    /**
         * @OA\Info(
         *    title="Your super Application API",
         *    version="1.0.0",
         * )
         * @OA\Get(
         *     path="/dapil",
         *     summary="Get Dapil",
         *     tags={"Authentication"},
         *     @OA\Response(response="200", description="Successful retrieval of Dapil data"),
         *     @OA\Response(response="401", description="Unauthorized"),
         * )
     */
    public function dapil()
    {
        try {
            $data = DB::table('dapil')
                ->select('dapil.id as id_dapil', 'dapil.provinsi as namaProvinsi')
                ->orderBy('dapil.updated_at', 'desc')
                ->get();

            $result = [];

            foreach ($data as $row) {
                $result[] = [
                    'id_dapil' => $row->id_dapil,
                    'provinsi' => $row->namaProvinsi
                ];
            }

            return response()->json(['data' => $result], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    /**
     * @OA\Info(
     *    title="Your super Application API",
     *    version="1.0.0",
     * )
     * @OA\Get(
     *     path="/kota",
     *     summary="Get kota",
     *     tags={"Dapil"},
     *     @OA\Response(response="200", description="Successful retrieval of Dapil data"),
     *     @OA\Response(response="401", description="Unauthorized"),
     * )
     */
    public function kota()
    {
        try {
            $data = DB::table('dapil')
                ->select('dapil.id as id_dapil','dapil.kota_kabupaten as namaKota')
                ->orderBy('dapil.updated_at', 'desc')
                ->get();

            $result = [];

            
            foreach ($data as $row) {
                $result[] = [
                    'id_dapil' => $row->id_dapil,
                    'kota_kabupaten' => $row->namaKota,
                ];
            }

            return response()->json(['data' => $result], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
         * @OA\Info(
         *    title="Your super Application API",
         *    version="1.0.0",
         * )
         * @OA\Get(
         *     path="/kecamatan",
         *     summary="Get Kecamatan",
         *     tags={"Authentication"},
         *     @OA\Parameter(
         *         name="id_user",
         *         in="path",
         *         description="ID user",
         *         required=false
         *     ),
         *     @OA\Response(response="200", description="Successful retrieval of Dapil data"),
         *     @OA\Response(response="401", description="Unauthorized"),
         * )
     */

    public function kecamatan($idUser)
    {
        try {
            //$getIdUser =  User::where('id', $idUser)->get();
            $data = DB::table(function($query) use ($idUser) {
                $query->select(
                    'kecamatan.id as idkecamatan',
                    'kecamatan.nama_kecamatan as namekecamatan'
                )
                ->from('tps')
                ->join('rtrw', 'rtrw.id', '=', 'tps.id_rtrw')
                ->join('desa', 'desa.id', '=', 'rtrw.id_desa')
                ->join('kecamatan', 'kecamatan.id', '=', 'desa.id_kecamatan')
                ->where('tps.id_user', $idUser)
                ->groupBy('idkecamatan', 'namekecamatan');
            })->get();
            $result = [];

            foreach ($data as $row) {
                $result[] = [
                    'idkecamatan' => $row->idkecamatan,
                    'namekecamatan' => $row->namekecamatan
                ];
            }

            return response()->json(['data' => $result], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

     /**
         * @OA\Info(
         *    title="Your super Application API",
         *    version="1.0.0",
         * )
         * @OA\Get(
         *     path="/desa",
         *     summary="Get Desa",
         *     tags={"Authentication"},
         *     @OA\Parameter(
         *         name="id_user",
         *         in="path",
         *         description="ID user",
         *         required=false
         *     ),
         *     @OA\Response(response="200", description="Successful retrieval of Dapil data"),
         *     @OA\Response(response="401", description="Unauthorized"),
         * )
     */

     public function desa($idUser)
     {
         try {
             //$getIdUser =  User::where('id', $idUser)->get();
             $data = DB::table(function($query) use ($idUser) {
                 $query->select(
                     'desa.id as iddesa',
                     'desa.nama_desa as namedesa'
                 )
                 ->from('tps')
                 ->join('rtrw', 'rtrw.id', '=', 'tps.id_rtrw')
                 ->join('desa', 'desa.id', '=', 'rtrw.id_desa')
                 ->where('tps.id_user', $idUser)
                 ->groupBy('iddesa', 'namedesa');
             })->get();
             $result = [];
 
             foreach ($data as $row) {
                 $result[] = [
                     'iddesa' => $row->iddesa,
                     'namedesa' => $row->namedesa
                 ];
             }
 
             return response()->json(['data' => $result], 200);
         } catch (\Exception $e) {
             return response()->json(['error' => 'Internal Server Error'], 500);
         }
     }

     /**
         * @OA\Info(
         *    title="Your super Application API",
         *    version="1.0.0",
         * )
         * @OA\Get(
         *     path="/rtrw",
         *     summary="Get Rt Rw",
         *     tags={"Authentication"},
         *     @OA\Parameter(
         *         name="id_user",
         *         in="path",
         *         description="ID user",
         *         required=false
         *     ),
         *     @OA\Response(response="200", description="Successful retrieval of Dapil data"),
         *     @OA\Response(response="401", description="Unauthorized"),
         * )
     */

     public function rtrw($idUser)
     {
         try {
             //$getIdUser =  User::where('id', $idUser)->get();
             $data = DB::table(function($query) use ($idUser) {
                $query->select(
                    'rtrw.id as idrtrw',
                    DB::raw("CONCAT( 'RT','',rtrw.rt, '/','RW' ,rtrw.rw) AS namertrw") // Menggabungkan RT dan RW menjadi satu kolom
                )
                ->from('tps')
                ->join('rtrw', 'rtrw.id', '=', 'tps.id_rtrw')
                ->where('tps.id_user', $idUser)
                ->groupBy('idrtrw', 'namertrw', 'rtrw.rt', 'rtrw.rw'); // Pastikan untuk mengelompokkan juga berdasarkan kolom yang baru digabungkan
            })->get();
             $result = [];
 
             foreach ($data as $row) {
                 $result[] = [
                     'idrtrw' => $row->idrtrw,
                     'namertrw' => $row->namertrw
                 ];
             }
 
             return response()->json(['data' => $result], 200);
         } catch (\Exception $e) {
             return response()->json(['error' => 'Internal Server Error'], 500);
         }
     }

     /**
         * @OA\Info(
         *    title="Your super Application API",
         *    version="1.0.0",
         * )
         * @OA\Get(
         *     path="/tps",
         *     summary="Get Tps",
         *     tags={"Authentication"},
         *     @OA\Parameter(
         *         name="id_user",
         *         in="path",
         *         description="ID user",
         *         required=false
         *     ),
         *     @OA\Response(response="200", description="Successful retrieval of Dapil data"),
         *     @OA\Response(response="401", description="Unauthorized"),
         * )
     */

     public function tps($idUser)
     {
         try {
             //$getIdUser =  User::where('id', $idUser)->get();
             $data = DB::table(function($query) use ($idUser) {
                $query->select(
                    'tps.id_tps as idtps',
                    DB::raw("CONCAT( 'TPS',' - ',tps.name_tps) AS nametps") 
                )
                ->from('tps')
                ->where('tps.id_user', $idUser)
                ->groupBy('idtps', 'nametps');
            })->get();
             $result = [];
 
             
             foreach ($data as $row) {
                 $result[] = [
                     'idtps' => $row->idtps,
                     'nametps' => $row->nametps
                 ];
             }
 
             return response()->json(['data' => $result], 200);
         } catch (\Exception $e) {
             return response()->json(['error' => 'Internal Server Error'], 500);
         }
     }

    /**
        * @OA\Info(
        *    title="Your super  ApplicationAPI",
        *    version="1.0.0",
        * )
     * @OA\Post(
     *     path="/insertDetailDapil",
     *     summary="Insert dapil",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_dapil,id_camat"},
    
     *             @OA\Property(property="id_user", type="string", format="string", example=""),
     *             @OA\Property(property="id_dapil", type="string", format="string", example=""),
     *             @OA\Property(property="id_camat", type="string", format="string", example=""),
     *             @OA\Property(property="id_desa", type="string", format="string", example=""),
     *             @OA\Property(property="id_rtrw", type="string", format="string", example=""),
     *             @OA\Property(property="id_tps", type="string", format="string", example="")
     *         )
     *     ), 
     *     @OA\Response(response="200", description="Successful loginmobile"),
     *     @OA\Response(response="401", description="Unauthorized"),
     * )
     */

    public function insertDetailDapil(Request $request)
    {
        try {
            
            $validator = Validator::make($request->all(), [
                'id_dapil' => 'required',
                'id_camat' => 'required',
            ]);
            // Validasi input
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
    
            DB::beginTransaction();
    
            $data = DetailDapilModel::create([
                'id_user' => $request->id_user,
                'id_tps' => $request->id_tps,
                'id_rtrw' => $request->id_rtrw,
                'id_desa' => $request->id_desa,
                'id_kecamatan' => $request->id_camat,
                'id_dapil' => $request->id_dapil,
                'created_by' => $request->id_user,
                'modified_by' => $request->id_user,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'status_input' => 1,
            ]);
            $lastId = $data->getKey();
            
            DB::commit();
    
            // Include uploaded image details in the response
            return response()->json(['message' => 'Berhasil insert data', 'iddtldapil' => $lastId], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    /**
         * @OA\Info(
         *    title="Your super Application API",
         *    version="1.0.0",
         * )
         * @OA\Get(
         *     path="/candidates",
         *     summary="Get candidates",
         *     tags={"Authentication"},
         *     @OA\Response(response="200", description="Successful retrieval of Dapil data"),
         *     @OA\Response(response="401", description="Unauthorized"),
         * )
     */
    public function candidates()
    {
        try {
            $data = DB::table('caleg')
                ->select('caleg.id_caleg as id', 'caleg.name_caleg as nama')
                ->orderBy('caleg.updated_at', 'desc')
                ->get();

            $result = [];

            foreach ($data as $row) {
                $result[] = [
                    'id' => $row->id,
                    'nama' => $row->nama
                ];
            }

            return response()->json(['data' => $result], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    

    /**
        * @OA\Info(
        *    title="Your super  ApplicationAPI",
        *    version="1.0.0",
        * )
     * @OA\Post(
     *     path="/vote",
     *     summary="Insert suara caleg",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
    *              required={"id", "suara", "iddapil", "idtps", "iduser"},
     *             @OA\Property(property="id", type="string", example="1"),
     *             @OA\Property(property="suara", type="string", example="100"),
     *             @OA\Property(property="iddapil", type="string", example="2"),
     *             @OA\Property(property="idtps", type="string", example="3"),
     *             @OA\Property(property="iduser", type="string", example="4")
     *         )
     *     ), 
     *     @OA\Response(response="200", description="Successful loginmobile"),
     *     @OA\Response(response="401", description="Unauthorized"),
     * )
     */

    public function vote(Request $request)
    {
            // Validasi request jika diperlukan
            
            $validatedData = $request->validate([
                '*.id' => 'required|string',
                '*.suara' => 'required|string',
                '*.iddapil' => 'required|string',
                '*.idtps' => 'required|string',
                '*.iduser' => 'required|string'
            ]);
            foreach ($validatedData as $data) {
                CalculateModel::create([
                    'id_caleg' => $data['id'],
                    'totalsuara_caleg' => $data['suara'],
                    'id_dtl' => $data['iddapil'],
                    'id_tps' => $data['idtps'],
                    'id_user' => $data['iduser'],
                    'created_by' => $data['iduser'],
                    'modified_by' => $data['iduser'],
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now(),
                ]);
            }

            // Respon sukses jika diperlukan
            return response()->json(['message' => 'Data kandidat berhasil disimpan'], 200);
    }

}
