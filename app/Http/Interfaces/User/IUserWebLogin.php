<?php

namespace App\Http\Interfaces\User;

use App\Models\User;

interface IUserWebLogin
{
    function login(string $email, string $password): ?User;
}
