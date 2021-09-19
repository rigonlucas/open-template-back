<?php

namespace App\Http\Interfaces\User;

interface IUserAPILogin
{
    function login(string $email, string $password): array;
}
