<?php

namespace App\Http\Interfaces\UserPermission;

use App\Models\UserPermission;

interface IUserPermissionStore
{
    function store(int $user_id, int $permission): ?UserPermission;
}
