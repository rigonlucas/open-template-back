<?php

namespace App\Services\UserPermission;

use App\Http\Interfaces\UserPermission\IUserPermissionDelete;
use App\Http\Interfaces\UserPermission\IUserPermissionStore;
use App\Models\UserPermission;

class UserPermissionService implements IUserPermissionStore, IUserPermissionDelete
{

    function store(int $user_id, string $permission): ?UserPermission
    {
        return UserPermission::updateOrCreate([
            'user_id' => $user_id,
            'permission' => $permission,
        ]);
    }

    function delete(int $id, int $user_id): bool
    {
        return UserPermission::where('id', $id)->where('user_id', $user_id)->delete();
    }
}