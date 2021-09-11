<?php

namespace App\Repositories\User;

use App\Http\Interfaces\User\IUserStore;
use App\Models\User;

class UserStoreRepo implements IUserStore
{

    function store($fields): User
    {
        return User::create($fields);
    }
}