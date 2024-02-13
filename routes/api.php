<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginMobileController;
use App\Http\Controllers\ApiImageController;
use App\Http\Controllers\ApiDapilController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/loginmobile', [LoginMobileController::class, 'loginmobile']);

Route::post('/uploadimage', [ApiImageController::class, 'uploadimage']);

Route::get('/dapil', [ApiDapilController::class, 'dapil']);
Route::get('/kota', [ApiDapilController::class, 'kota']);
Route::get('/kecamatan/{id_user}', [ApiDapilController::class, 'kecamatan']);
Route::get('/desa/{id_user}', [ApiDapilController::class, 'desa']);
Route::get('/rtrw/{id_user}', [ApiDapilController::class, 'rtrw']);
Route::get('/tps/{id_user}', [ApiDapilController::class, 'tps']);
Route::post('/insertDetailDapil', [ApiDapilController::class, 'insertDetailDapil']);

Route::get('/candidates', [ApiDapilController::class, 'candidates']);

Route::post('/vote', [ApiDapilController::class, 'vote']);