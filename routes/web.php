<?php

use App\Http\Controllers\Auth\AuthWebController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth']], function (){
    Route::get('/home', function () {
        return view('welcome');
    })->name('home');
});

Route::get('login', [AuthWebController::class, 'createLogin'])->name('login');
Route::post('login', [AuthWebController::class, 'login'])->name('post.login');

Route::get('register', [AuthWebController::class, 'createRegister'])->name('register');
Route::post('register', [AuthWebController::class, 'register'])->name('post.register');

//Route::post('logout', [AuthWebController::class, 'logout'])->name('logout')->middleware( 'auth:sanctum');

