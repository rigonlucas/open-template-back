<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthWebController extends Controller
{

    public function createLogin(){

        return View('auth.login');
    }

    public function createRegister(){
        return View('auth.register');
    }

    public function register(RegisterRequest $request){

    }

    public function login(LoginRequest $request){

    }

    public function logout(){

    }
}
