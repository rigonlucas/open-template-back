<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware( 'auth:sanctum');


Route::prefix('admin')->group(function (){
    Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {

    });
});

Route::prefix('superadmin')->group(function (){
    Route::group(['middleware' => ['auth:sanctum', 'super.admin']], function () {
        Route::get('user/lista', [UserController::Class, 'index'])->name('superadmin.user.list');
        Route::put('user/update', [UserController::Class, 'update'])->name('superadmin.user.update');
    });
});
