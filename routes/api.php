<?php

use App\Http\Controllers\Auth\AuthAPIController;
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

Route::post('login', [AuthAPIController::class, 'login'])->name('api.login');
Route::post('register', [AuthAPIController::class, 'register'])->name('api.register');
Route::post('logout', [AuthAPIController::class, 'logout'])->name('api.logout')->middleware( 'auth:sanctum');

// only auth
Route::group(['middleware' => ['auth:sanctum']], function () {

    /**
     * USER RATE
     */
    Route::post('rate', [RateController::class, 'store'])->name('api.rate');
    Route::get('rate/check', [RateController::class, 'checkRateUser'])->name('api.rate.check');

});

Route::prefix('account')->group(function (){
    Route::group(['middleware' => ['auth:sanctum']], function () {
        /**
         * USER ADDRESS
         */
        Route::get('address/list', [UsersAddressController::class, 'index'])->name('api.account.address.index');
        Route::get('address/show/{hash}', [UsersAddressController::class, 'show'])->name('api.account.address.show');
        Route::post('address/store', [UsersAddressController::class, 'store'])->name('api.account.address.store');
        Route::put('address/update/{hash}', [UsersAddressController::class, 'update'])->name('api.account.address.update');
        Route::delete('address/delete/{hash}', [UsersAddressController::class, 'delete'])->name('api.account.address.delete');
        Route::patch('address/restore/{hash}', [UsersAddressController::class, 'restore'])->name('api.account.address.restore');
        Route::delete('address/forceDelete/{hash}', [UsersAddressController::class, 'forceDelete'])->name('api.account.address.forceDelete');

        /**
         * USER CONTACTS
         */
        Route::get('contact/list', [UserContactController::class, 'index'])->name('api.account.contact.index');
        Route::get('contact/show/{hash}', [UserContactController::class, 'show'])->name('api.account.contact.show');
        Route::post('contact/store', [UserContactController::class, 'store'])->name('api.account.contact.store');
        Route::put('contact/update/{hash}', [UserContactController::class, 'update'])->name('api.account.contact.update');
        Route::delete('contact/delete/{hash}', [UserContactController::class, 'delete'])->name('api.account.contact.delete');
        Route::patch('contact/restore/{hash}', [UserContactController::class, 'restore'])->name('api.account.contact.restore');
        Route::delete('contact/forceDelete/{hash}', [UserContactController::class, 'forceDelete'])->name('api.account.contact.forceDelete');

        /**
         * USER REGISTER
         */
        Route::put('user/update', [UserController::Class, 'update'])->name('api.account.user.update');
    });
});

Route::prefix('admin')->group(function (){
    Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {
        /**
         * >>>>>>>>>
         */

    });
});

Route::prefix('superadmin')->group(function (){
    Route::group(['middleware' => ['auth:sanctum', 'super.admin']], function () {
        /**
         * USER MANAGER
         */
        Route::get('user/list', [UserController::Class, 'index'])->name('api.superadmin.user.list');
        Route::get('user/show/{id}', [UserController::Class, 'show'])->name('api.superadmin.user.show.id');
        Route::put('user/disable', [UserController::Class, 'disable'])->name('api.superadmin.user.disable');
        Route::put('user/enable', [UserController::Class, 'enable'])->name('api.superadmin.user.enable');

        /**
         * USER PERMISSIONS MANAGER
         */
        Route::post('permissions/store', [PermissionsController::class, 'store'])->name('api.superadmin.permission.store');
        Route::delete('permissions/delete', [PermissionsController::class, 'delete'])->name('api.superadmin.permission.delete');
    });
});
