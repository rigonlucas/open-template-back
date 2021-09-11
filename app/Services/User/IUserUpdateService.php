<?php

namespace App\Services\User;

interface IUserUpdateService
{
    function update(array $fields): int;
}