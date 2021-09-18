<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Rate\RateController;
use App\Http\Controllers\User\PermissionsController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UsersAddressController;
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

Route::group(['middleware' => ['auth:sanctum']], function () {
    // only auth

    // RATE
    Route::post('rate', [RateController::class, 'store'])->name('rate');
    Route::get('rate/check', [RateController::class, 'checkRateUser'])->name('rate.check');

    // USERS ADDRESSES
    Route::get('user/address/list', [UsersAddressController::class, 'index'])->name('user.address.index');
    Route::get('user/address/show/{hash}', [UsersAddressController::class, 'show'])->name('user.address.show');
    Route::post('user/address/store', [UsersAddressController::class, 'store'])->name('user.address.store');
    Route::put('user/address/update/{hash}', [UsersAddressController::class, 'update'])->name('user.address.update');
    Route::delete('user/address/delete/{hash}', [UsersAddressController::class, 'delete'])->name('user.address.delete');
    Route::patch('user/address/restore/{hash}', [UsersAddressController::class, 'restore'])->name('user.address.restore');
    Route::delete('user/address/forceDelete/{hash}', [UsersAddressController::class, 'forceDelete'])->name('user.address.forceDelete');
});

Route::prefix('admin')->group(function (){
    Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {

    });
});

Route::prefix('superadmin')->group(function (){
    Route::group(['middleware' => ['auth:sanctum', 'super.admin']], function () {
        /**
         * USER MANAGER
         */
        Route::get('user/list', [UserController::Class, 'index'])->name('superadmin.user.list');
        Route::get('user/show/{id}', [UserController::Class, 'show'])->name('superadmin.user.show.id');
        Route::put('user/update', [UserController::Class, 'update'])->name('superadmin.user.update');
        Route::put('user/disable', [UserController::Class, 'disable'])->name('superadmin.user.disable');
        Route::put('user/enable', [UserController::Class, 'enable'])->name('superadmin.user.enable');

        /**
         * USER PERMISSIONS MANAGER
         */
        Route::post('permissions/store', [PermissionsController::class, 'store'])->name('superadmin.permission.store');
        Route::delete('permissions/delete', [PermissionsController::class, 'delete'])->name('superadmin.permission.delete');
    });
});
