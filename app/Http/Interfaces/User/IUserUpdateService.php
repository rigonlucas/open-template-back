<?php

namespace App\Http\Interfaces\User;

interface IUserUpdateService
{
    function update(array $fields): int;
}