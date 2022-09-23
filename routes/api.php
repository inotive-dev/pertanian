<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SaranController;
use App\Http\Controllers\API\LaporanController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\DashboardController;

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


Route::post('login-validate',[AuthController::class,'loginValidate']);
Route::post('forget-password',[AuthController::class,'forgetPassword']);
Route::post('check-otp',[AuthController::class,'checkOTP']);
Route::post('reset-password',[AuthController::class,'resetPassword']);

Route::post('saran',[SaranController::class,'storeSaran']);



Route::group(['middleware' => ['auth:sanctum']], function () {
    // laporan
    Route::get('laporan',[LaporanController::class,'index']);
    Route::get('laporan/{id}',[LaporanController::class,'detailLaporan']);
    Route::post('laporan',[LaporanController::class,'storeLaporan']);
    Route::post('update-laporan/{id}',[LaporanController::class,'updateLaporan']);
    Route::get('laporan-verifikasi',[LaporanController::class,'indexVerifikasi']);
    Route::delete('delete-laporan/{id}',[LaporanController::class,'destroy']);

    // profile
    Route::post('update-profile',[ProfileController::class,'updateProfile']);
    Route::post('get-profile',[ProfileController::class,'getProfile']);

    //dashboard
    Route::get('dashboard',[DashboardController::class,'index']);
    Route::get('comodities',[DashboardController::class,'getAllComodity']);
});

Route::get('/not-authenticated', [AuthController::class, 'notAuthenticated'])->name('not-authenticated');