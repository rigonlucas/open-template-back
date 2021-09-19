<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\Auth\CredendialsWrongException;
use App\Helpers\ResponseDataBuilder;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\User\IUserAPILogin;
use App\Http\Interfaces\User\IUserAPILogout;
use App\Http\Interfaces\User\IUserAPIRegister;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AuthAPIController extends Controller
{
    private IUserAPIRegister $userRegister;
    private IUserAPILogin $userLogin;
    private IUserAPILogout $userLogout;


    /**
     * @param IUserAPIRegister $userRegister
     * @param IUserAPILogin $userLogin
     * @param IUserAPILogout $userLogout
     */
    public function __construct(IUserAPIRegister $userRegister, IUserAPILogin $userLogin, IUserAPILogout $userLogout)
    {
        $this->userRegister = $userRegister;
        $this->userLogin = $userLogin;
        $this->userLogout = $userLogout;
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $fields = $request->validated();
            Arr::set($fields, 'password', bcrypt($fields['password']));
            return response()->json(ResponseDataBuilder::buildWithData("Login realizado pelo registro", $this->userRegister->register($fields['name'], $fields['email'], $fields['password'])), 200);
        }catch (Exception $ex){
            return response()->json($ex, 500);
        }
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $fields = $request->validated();
            return response()->json(ResponseDataBuilder::buildWithData("Login realizado", $this->userLogin->login($fields['email'], $fields['password'])), 200);
        } catch (CredendialsWrongException){
            return response()->json(ResponseDataBuilder::buildWithoutData("Credenciais erradas"), 401);
        } catch (Exception $ex){
            return response()->json($ex, 500);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request){
        try {
            $this->userLogout->singleLogout();
            return response()->json(ResponseDataBuilder::buildWithoutData("Logout ok"), 200);
        }catch (Exception $ex){
            return response()->json($ex, 500);
        }
    }
}
