<?php

namespace App\Http\Interfaces\User;

interface IUserActive
{
    function enable(int $id) : bool;

    function disable(int $id) : bool;
}