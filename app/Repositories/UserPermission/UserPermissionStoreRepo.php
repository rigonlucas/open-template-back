<?php

namespace App\Repositories\UserPermission;

use App\Http\Interfaces\UserPermission\IUserPermissionStore;
use App\Models\UserPermission;

class UserPermissionStoreRepo implements IUserPermissionStore
{

    function store(array $fields): UserPermission
    {
        return UserPermission::create($fields);
    }
}
