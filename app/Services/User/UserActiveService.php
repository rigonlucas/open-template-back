<?php

namespace App\Services\User;

use App\Http\Interfaces\User\IUserActive;
use App\Http\Interfaces\User\IUserDelete;

class UserActiveService implements IUserActive
{
    private IUserDelete $userDelete;

    public function __construct(IUserDelete $userDelete)
    {
        $this->userDelete = $userDelete;
    }

    function enable(array $field): bool
    {
        return $this->userDelete->enable($field['id']);
    }

    function disable(array $field): bool
    {
        return $this->userDelete->disable($field['id']);
    }
}