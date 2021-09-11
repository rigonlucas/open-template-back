<?php

namespace App\Http\Interfaces\UserPermission;

use App\Models\UserPermission;

interface IUserPermissionStore
{
    function store(Array $fields): UserPermission;
}
