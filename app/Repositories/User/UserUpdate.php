<?php

namespace App\Repositories\User;

use App\Http\Interfaces\User\IUserUpdate;
use App\Models\User;

class UserUpdate implements IUserUpdate
{

    public function update(array $fields): int
    {
        return User::find($fields['id'])->update($fields);
    }
}