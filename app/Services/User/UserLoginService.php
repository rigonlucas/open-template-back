<?php

namespace App\Services\User;

use App\Exceptions\Auth\CredendialsWrongException;
use App\Helpers\ResponseDataBuilder;
use App\Http\Interfaces\User\IUserFind;
use App\Http\Interfaces\User\IUserLogin;
use Illuminate\Support\Facades\Hash;

class UserLoginService implements IUserLogin
{
    private IUserFind $userFind;

    public function __construct(IUserFind $userFind)
    {
        $this->userFind = $userFind;
    }

    function login(array $fields): array
    {
        //$user = $this->userFind->findLogin($fields['email']);
        $user = $this->userFind->findLogin($fields['email']);

        if(!$user || !Hash::check($fields['password'], $user->password)){
            throw new CredendialsWrongException();
        }
        $token = $user->createToken("student")->plainTextToken;
        return ['user' => $user, 'token' => $token];
    }
}
