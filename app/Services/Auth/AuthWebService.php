<?php

namespace App\Services\Auth;

use App\Exceptions\Auth\CredendialsWrongException;
use App\Http\Interfaces\User\IUserFindRepo;
use App\Http\Interfaces\User\IUserWebLogin;
use App\Http\Interfaces\User\IUserWebLogout;
use App\Http\Interfaces\User\IUserWebRegister;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthWebService implements IUserWebRegister, IUserWebLogin, IUserWebLogout
{
    private IUserFindRepo $userFindRepo;

    public function __construct(IUserFindRepo $userFindRepo)
    {
        $this->userFindRepo = $userFindRepo;
    }

    function login(string $email, string $password): ?User
    {
        $user = $this->userFindRepo->findLogin($email);

        if(!$user || !Hash::check($password, $user->password)){
            throw new CredendialsWrongException();
        }
        Auth::login($user);
        return $user;
    }

    function singleLogout()
    {
        // TODO: Implement singleLogout() method.
    }

    function register(string $name, string $email, string $password): array
    {
        // TODO: Implement register() method.
    }
}