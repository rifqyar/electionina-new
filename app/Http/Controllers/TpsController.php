<?php

namespace App\Http\Controllers;
use DateTime;
use App\Models\TpsModel;
use App\Models\User;
use App\Models\RtrwModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Helpers\GenerateNumberHelpers;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; 
class TpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = 1;
        $user =  DB::table('users')->select('users.name as username','users.id as iduser')->get();
        $rtrw =  DB::table('rtrw')->select('rtrw.namertrw as namertrw','rtrw.id as idrtrw')->get();
        
        $data = DB::table('tps')
        ->join('users', 'tps.id_user', '=', 'users.id')
        ->join('rtrw', 'tps.id_rtrw', '=', 'rtrw.id')
        ->select('users.name as username', 'tps.name_tps','rtrw.alamat','rtrw.namertrw','tps.modified_by','tps.updated_at','users.email','users.id as iduser','tps.id_tps as idtps','tps.id_rtrw')
        ->orderBy('tps.updated_at', 'desc')
        ->get();
        return view('tps.index', compact('data','status','user','rtrw'));
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
                
            TpsModel::create([
                'name_tps' => $request->tpsname,
                'id_rtrw' => $request->rtrwId,
                'id_user' => $request->iduser,
                // 'created_by' => Auth::user()->name,
                // 'modified_by' => Auth::user()->name,
                'updated_at' => Carbon::now(),
                'created_at' =>Carbon::now(),
                'deletestatus' => 0,

            ]);
             
                DB::commit();
                return response()->json([
                    'url' => url('tps'),
                    'message' => 'Simpan Data Berhasil',
                    'status'=>200
                ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return response()->json([
                'url' => url('tps'),
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
    public function update(Request $request)
    {
      
        try {
            DB::beginTransaction();
                $updateValues = [];

                // Memeriksa dan menambahkan nilai id_rtrw jika tidak null
                if ($request->rtrwIdx !== null) {
                    $updateValues['id_rtrw'] = $request->rtrwIdx;
                }

                // Memeriksa dan menambahkan nilai id_user jika tidak null
                if ($request->iduserx !== null) {
                    $updateValues['id_user'] = $request->iduserx;
                }

                // Memeriksa dan menambahkan nilai name_tps jika tidak null
                if ($request->nametpsx !== null) {
                    $updateValues['name_tps'] = $request->nametpsx;
                }

                // Memeriksa dan menambahkan nilai modified_by jika tidak null
                if ($request->iduserx !== null) {
                    $updateValues['modified_by'] = $request->iduserx;
                }

                // Melakukan update hanya jika ada nilai yang tidak null
                if (!empty($updateValues)) {
                    TpsModel::where('id_tps', $request->idtpsx)->update($updateValues);
                }

                // Commit transaksi dan kembalikan respons
                DB::commit();
                return response()->json([
                    'url' => url('tps'),
                    'message' => 'Update Data Berhasil',
                    'status' => 200
                ]);
        }
        catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return response()->json([
                'url' => url('tps'),
                'message' => "Gagal Update Data",
                'status'=>400
            ]);
        }
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
