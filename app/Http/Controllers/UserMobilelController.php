<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Helpers\GenerateNumberHelpers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; 

class UserMobilelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $status = 1;
        
        $data = DB::table('users')
        ->select('users.name as usernameMobile','users.email','users.id as iduserMobile','users.updated_at','users.password')
        ->orderBy('users.updated_at', 'desc')
        ->get();
        return view('usermobile.index', compact('data','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);
            DB::beginTransaction();   
                
            User::create([
                'name' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request['password']),
                'updated_at' => Carbon::now(),
                'created_at' =>Carbon::now(),
                'deletestatus' => 0,

            ]);
             
                DB::commit();
                return response()->json([
                    'url' => url('usermobile'),
                    'message' => 'Simpan Data Berhasil',
                    'status'=>200
                ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return response()->json([
                'url' => url('usermobile'),
                'message' => $th->getMessage(),
                'status'=>400
            ]);
        }
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
        DB::beginTransaction();

        try {
            // Mendapatkan user berdasarkan id
            $flight = User::find($request->iduserx);
            
            // Memeriksa apakah user ditemukan
            if ($flight) {
                // Memeriksa dan mengupdate nama jika tidak null
                if ($request->nameuserx !== null) {
                    $flight->name = $request->nameuserx;
                }

                // Memeriksa dan mengupdate email jika tidak null
                if ($request->emailx !== null) {
                    $flight->email = $request->emailx;
                }

                // Memeriksa dan mengupdate password jika tidak null
                if ($request->password !== null) {
                    $flight->password = Hash::make($request->password);
                }

                // Memeriksa dan mengupdate timestamp
                $flight->updated_at = Carbon::now()->formatLocalized('%A, %d %B %Y');

                // Menyimpan perubahan
                $flight->save();
            }

            // Commit transaksi
            DB::commit();

            // Kembalikan respons sukses
            return response()->json([
                'url' => url('usermobile'),
                'message' => 'Update Data Berhasil',
                'status' => 200
            ]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi dan kembalikan pesan error
            DB::rollBack();
            dd($th);
            return response()->json([
                'url' => url('usermobile'),
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
