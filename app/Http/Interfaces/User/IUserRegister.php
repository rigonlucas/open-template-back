<?php

namespace App\Http\Interfaces\User;

use App\Models\User;

interface IUserRegister
{
    function registerStudent(Array $fields): array;
}
