<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\Auth\CredendialsWrongException;
use App\Helpers\ResponseDataBuilder;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\User\IUserLogin;
use App\Http\Interfaces\User\IUserLogout;
use App\Http\Interfaces\User\IUserRegister;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class AuthController extends Controller
{
    private IUserRegister $userRegister;
    private IUserLogin $userLogin;
    private IUserLogout $userLogout;


    /**
     * @param IUserRegister $userRegister
     * @param IUserLogin $userLogin
     * @param IUserLogout $userLogout
     */
    public function __construct(IUserRegister $userRegister, IUserLogin $userLogin, IUserLogout $userLogout)
    {
        $this->userRegister = $userRegister;
        $this->userLogin = $userLogin;
        $this->userLogout = $userLogout;
    }

    /**
     * @param RegisterRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function register(RegisterRequest $request)
    {
        try {
            $fields = $request->validated();
            Arr::set($fields, 'password', bcrypt($fields['password']));
            return response(ResponseDataBuilder::buildWithData("Login realizado pelo registro", $this->userRegister->register($fields)), 200);
        }catch (Exception $ex){
            return response($ex, 500);
        }
    }

    /**
     * @param LoginRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function login(LoginRequest $request)
    {
        try {
            return response(ResponseDataBuilder::buildWithData("Login realizado", $this->userLogin->login($request->validated())), 200);
        } catch (CredendialsWrongException){
            return response(ResponseDataBuilder::buildWithoutData("Credenciais erradas"), 401);
        } catch (Exception $ex){
            return response($ex, 500);
        }
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function logout(Request $request){
        try {
            $this->userLogout->singleLogout();
            return response(ResponseDataBuilder::buildWithoutData("Logout ok"), 200);
        }catch (Exception $ex){
            return response($ex, 500);
        }
    }
}
