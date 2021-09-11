<?php

namespace App\Http\Interfaces\UserPermission;

use App\Models\UserPermission;

interface IUserPermissionService
{
    function store (array $field) : ?UserPermission;
}