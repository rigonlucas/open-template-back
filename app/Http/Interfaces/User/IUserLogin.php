<?php

namespace App\Http\Interfaces\User;

interface IUserLogin
{
    function login(Array $fields): array;
}
