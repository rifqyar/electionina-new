<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class LoginMobileController extends Controller
{
    /**
        * @OA\Info(
        *    title="Your super  ApplicationAPI",
        *    version="1.0.0",
        * )
     * @OA\Post(
     *     path="   ",
     *     summary="logins",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email", example=""),
     *             @OA\Property(property="password", type="string", format="password", example="")
     *         )
     *     ), 
     *     @OA\Response(response="200", description="Successful loginmobile"),
     *     @OA\Response(response="401", description="Unauthorized"),
     * )
     */
    public function loginmobile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Validasi input
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        
        // Cek data di database
        $user = User::where('email', $request->email)->first();
        
        // Periksa apakah pengguna tidak ditemukan atau kata sandi tidak cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Kredensial tidak valid'], 401);
        } else {
            return response()->json(['message' => 'Login berhasil','id_user' => $user->id], 200);
        }
    }
}
