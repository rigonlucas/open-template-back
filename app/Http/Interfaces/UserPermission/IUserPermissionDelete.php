<?php

namespace App\Http\Interfaces\UserPermission;

interface IUserPermissionDelete
{
    function delete(int $id, int $user_id) : bool;
}