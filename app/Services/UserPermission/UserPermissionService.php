<?php

namespace App\Services\UserPermission;

use App\Http\Interfaces\UserPermission\IUserPermissionService;
use App\Models\UserPermission;

class UserPermissionService implements IUserPermissionService
{

    function store(array $field): ?UserPermission
    {
        dd($field);
    }
}