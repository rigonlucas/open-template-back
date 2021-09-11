<?php

namespace App\Services\User;

use App\Http\Interfaces\User\IUserRegister;
use App\Http\Interfaces\User\IUserStore;
use App\Http\Interfaces\UserPermission\IUserPermissionStore;
use App\Models\User;

class UserRegisterService implements IUserRegister
{
    private IUserStore $userStore;
    private IUserPermissionStore $userPermissionStore;

    public function __construct(IUserStore $userStore, IUserPermissionStore $userPermissionStore)
    {
        $this->userStore = $userStore;
        $this->userPermissionStore = $userPermissionStore;
    }

    function registerStudent(array $fields): array
    {
        $user = $this->userStore->store($fields);
        $token = $user->createToken(env('APP_KEY'))->plainTextToken;
        $this->userPermissionStore->store(['user_id' => $user->id, 'permission' => 'redacao']);
        return [
                'user' => User::with('permissions')->find($user->id),
                'token' => $token,
            ];
    }
}
