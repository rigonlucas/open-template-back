<?php

namespace App\Http\Interfaces\User;

interface IUserDelete
{
    function enable(int $user_id) : bool;

    function disable(int $user_id) : bool;
}