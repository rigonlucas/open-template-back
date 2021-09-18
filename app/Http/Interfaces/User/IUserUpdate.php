<?php

namespace App\Http\Interfaces\User;

interface IUserUpdate
{
    function update(int $id, string $name, string $email): int;
}