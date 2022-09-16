<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManajemenUserController;
use App\Http\Controllers\SaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;

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
    return redirect()->route('dashboard.index');
});

Route::get('login',[AuthController::class,'indexLogin'])->name('login');
Route::post('login-validate',[AuthController::class,'login']);

Route::group(['middleware' => ['auth','rolechecker:Super Admin']], function () {
    Route::resource('manajemen-user', ManajemenUserController::class);
    Route::get('/get-detail-user',[ManajemenUserController::class,'getDetail'])->name('manajemen-user.get-detail-user');
    Route::get('/email-available-check',[ManajemenUserController::class,'emailCheck'])->name('email-available-check');

    Route::resource('saran', SaranController::class);

    Route::resource('laporan', LaporanController::class);
    Route::get('/verify-laporan/{id}',[LaporanController::class,'verifyLaporan'])->name('verify-laporan');
    Route::get('/get-detail-laporan',[LaporanController::class,'getDetail'])->name('laporan.get-detail-laporan');

    Route::resource('dashboard', DashboardController::class);
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
});