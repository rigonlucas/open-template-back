<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Rate\RateController;
use App\Http\Controllers\User\PermissionsController;
use App\Http\Controllers\User\UserContactController;
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

});

Route::prefix('account')->group(function (){
    Route::group(['middleware' => ['auth:sanctum']], function () {
        // USERS ADDRESSES
        Route::get('address/list', [UsersAddressController::class, 'index'])->name('user.address.index');
        Route::get('address/show/{hash}', [UsersAddressController::class, 'show'])->name('user.address.show');
        Route::post('address/store', [UsersAddressController::class, 'store'])->name('user.address.store');
        Route::put('address/update/{hash}', [UsersAddressController::class, 'update'])->name('user.address.update');
        Route::delete('address/delete/{hash}', [UsersAddressController::class, 'delete'])->name('user.address.delete');
        Route::patch('address/restore/{hash}', [UsersAddressController::class, 'restore'])->name('user.address.restore');
        Route::delete('address/forceDelete/{hash}', [UsersAddressController::class, 'forceDelete'])->name('user.address.forceDelete');

        // USER CONTACTS
        Route::get('contact/list', [UserContactController::class, 'index'])->name('user.contact.index');
        Route::get('contact/show/{hash}', [UserContactController::class, 'show'])->name('user.contact.show');
        Route::post('contact/store', [UserContactController::class, 'store'])->name('user.contact.store');
        Route::put('contact/update/{hash}', [UserContactController::class, 'update'])->name('user.contact.update');
        Route::delete('contact/delete/{hash}', [UserContactController::class, 'delete'])->name('user.contact.delete');
        Route::patch('contact/restore/{hash}', [UserContactController::class, 'restore'])->name('user.contact.restore');
        Route::delete('contact/forceDelete/{hash}', [UserContactController::class, 'forceDelete'])->name('user.contact.forceDelete');
    });
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
