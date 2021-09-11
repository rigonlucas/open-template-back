<?php

namespace App\Http\Interfaces\User;

interface IUserActive
{
    function enable(array $field) : bool;

    function disable(array $field) : bool;
}