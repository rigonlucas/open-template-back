<?php

namespace App\Http\Interfaces\User;

interface IUserLogin
{
    function login(string $email, string $password): array;
}
