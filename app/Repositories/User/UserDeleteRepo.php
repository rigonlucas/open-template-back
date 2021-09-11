<?php

namespace App\Repositories\User;

use App\Http\Interfaces\User\IUserDelete;
use App\Models\User;

class UserDeleteRepo implements IUserDelete
{

    function enable(int $user_id): bool
    {
        return User::withTrashed()->find($user_id)->restore();
    }

    function disable(int $user_id): bool
    {
        return User::withTrashed()->find($user_id)->delete();
    }
}