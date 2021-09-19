<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\Auth\CredendialsWrongException;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\User\IUserWebLogin;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthWebController extends Controller
{

    private IUserWebLogin $userWebLogin;

    public function __construct(IUserWebLogin $userWebLogin)
    {
        $this->userWebLogin = $userWebLogin;
    }

    public function createLogin(){

        return View('auth.login');
    }

    public function createRegister(){
        return View('auth.register');
    }

    public function login(LoginRequest $request){
        try {
            $user = $this->userWebLogin->login($request['email'], $request['password']);
            if($user != null){
                return redirect()->route('home');
            }
            return redirect()->route('login');
        } catch (CredendialsWrongException $cEx){
            dd($cEx);
        } catch (\Exception $ex){
            dd($ex);
        }
    }

    public function register(RegisterRequest $request){

    }

    public function logout(){

    }
}
