<?php

namespace App\Services\User;

use App\Exceptions\User\UserNotFoundException;
use App\Http\Interfaces\User\IUserFind;
use App\Http\Interfaces\User\IUserUpdate;
use App\Http\Interfaces\User\IUserUpdateService;
use Illuminate\Support\Arr;

class UserUpdateService implements IUserUpdateService
{
    private IUserUpdate $userUpdate;
    private IUserFind $userFind;

    public function __construct(IUserUpdate $userUpdate, IUserFind $userFind)
    {
        $this->userUpdate = $userUpdate;
        $this->userFind = $userFind;
    }

    function update(array $fields): int
    {
        $user = $this->userFind->find($fields['id']);
        if(empty($user)){
            throw new UserNotFoundException();
        }
        if($user->email != $fields['email']){
            Arr::set($fields, 'email_verified_at', null);
        }
        return $this->userUpdate->update($fields);
    }
}