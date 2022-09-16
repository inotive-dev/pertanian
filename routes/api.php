<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SaranController;
use App\Http\Controllers\API\AuthController;

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



Route::group(['middleware' => ['sanctum']], function () {
    //route
});