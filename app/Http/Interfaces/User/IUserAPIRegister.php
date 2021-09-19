<?php

namespace App\Http\Interfaces\User;

use App\Models\User;

interface IUserAPIRegister
{
    function register(string $name, string $email, string $password): array;
}
