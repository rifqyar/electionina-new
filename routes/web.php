<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TpsController;
use App\Http\Controllers\DapilController;
use App\Http\Controllers\PartaiController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\CalegController;
use App\Http\Controllers\UserMobilelController;
use App\Http\Controllers\CalculateController;
use App\Http\Controllers\VoteCalculateController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
//Route::post('/load-chart-data', [HomeController::class, 'loadChartData'])->name('load-chart-data');
Route::get('/load-chart-data', [HomeController::class, 'loadChartData']);
Route::get('/get-tps', [HomeController::class, 'getTpsByDesa']);


//Master calculate
Route::get('calculate', [CalculateController::class, 'index'])->name('calculate');

//Master Partai
Route::get('partai', [PartaiController::class, 'index'])->name('partai');
Route::post('partai/create', [PartaiController::class, 'create'])->name('partai.create');
Route::post('partai/update', [PartaiController::class, 'update'])->name('partai.update');


//Master Caleg
Route::get('caleg', [CalegController::class, 'index'])->name('caleg');
Route::post('caleg/create', [CalegController::class, 'create'])->name('caleg.create');
Route::post('caleg/update', [CalegController::class, 'update'])->name('caleg.update');


//Master Dapil
Route::get('dapil', [DapilController::class, 'index'])->name('dapil');
Route::post('dapil/create', [DapilController::class, 'create'])->name('dapil.create');
Route::post('dapil/update', [DapilController::class, 'update'])->name('dapil.update');

//Master kecamatan
Route::get('camat', [KecamatanController::class, 'index'])->name('camat');
Route::post('camat/create', [KecamatanController::class, 'create'])->name('camat.create');
Route::post('camat/update', [KecamatanController::class, 'update'])->name('camat.update');

//Master desa
Route::get('desa', [DesaController::class, 'index'])->name('desa');
Route::post('desa/create', [DesaController::class, 'create'])->name('desa.create');
Route::post('desa/update', [DesaController::class, 'update'])->name('desa.update');

//Master tps
Route::get('tps', [TpsController::class, 'index'])->name('tps');
Route::post('tps/create', [TpsController::class, 'create'])->name('tps.create');
Route::post('tps/update', [TpsController::class, 'update'])->name('tps.update');


//Master Usermobile
Route::get('usermobile', [UserMobilelController::class, 'index'])->name('usermobile');
Route::post('usermobile/create', [UserMobilelController::class, 'create'])->name('usermobile.create');
Route::post('usermobile/update', [UserMobilelController::class, 'update'])->name('usermobile.update');


//Master Partai
Route::get('votecaleg', [VoteCalculateController::class, 'index'])->name('votecaleg');
Route::post('votecaleg/create', [VoteCalculateController::class, 'create'])->name('votecaleg.create');
Route::post('votecaleg/update', [VoteCalculateController::class, 'update'])->name('votecaleg.update');

Route::get('/get-tpsvote', [VoteCalculateController::class, 'getTpsByDesavote']);