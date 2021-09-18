<?php

namespace App\Services\UserPermission;

use App\Http\Interfaces\UserPermission\IUserPermissionDelete;
use App\Http\Interfaces\UserPermission\IUserPermissionStore;
use App\Models\UserPermission;

class UserPermissionService implements IUserPermissionStore, IUserPermissionDelete
{

    function store(int $user_id, int $permission): ?UserPermission
    {
        dd($user_id, $permission);
    }

    function delete(int $id, int $user_id): bool
    {
        dd($id, $user_id);
    }
}