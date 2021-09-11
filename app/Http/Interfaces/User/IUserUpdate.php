<?php

namespace App\Http\Interfaces\User;

interface IUserUpdate
{
    function update(array $fields): int;
}