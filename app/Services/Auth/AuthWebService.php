<?php

namespace App\Services\Auth;

use App\Http\Interfaces\User\IUserAPILogin;
use App\Http\Interfaces\User\IUserAPILogout;
use App\Http\Interfaces\User\IUserAPIRegister;

class AuthWebService implements IUserAPIRegister, IUserAPILogin, IUserAPILogout
{

    function login(string $email, string $password): array
    {
        // TODO: Implement login() method.
    }

    function singleLogout()
    {
        // TODO: Implement singleLogout() method.
    }

    function register(string $name, string $email, string $password): array
    {
        // TODO: Implement register() method.
    }
}