<?php

namespace App\Http\Interfaces\UserPermission;

use App\Models\UserPermission;

interface IUserPermissionStore
{
    function store(int $user_id, string $permission): ?UserPermission;
}
