<?php

namespace App\Services\User;

use App\Http\Interfaces\User\IUserFind;
use App\Http\Interfaces\User\IUserLogout;
use Illuminate\Support\Facades\Auth;

class UserLogoutService implements IUserLogout
{
    private IUserFind $userFind;

    public function __construct(IUserFind $userFind)
    {
        $this->userFind = $userFind;
    }

    function singleLogout()
    {
        Auth::user()->currentAccessToken()->delete();
    }
}
