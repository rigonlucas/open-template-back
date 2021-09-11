<?php

namespace App\Http\Interfaces\User;

use App\Models\User;

interface IUserRegister
{
    function register(Array $fields): array;
}
