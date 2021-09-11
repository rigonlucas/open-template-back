<?php

namespace App\Http\Interfaces\User;

use App\Models\User;

interface IUserStore
{
    function store($fields) : User;
}
