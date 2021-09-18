<?php

namespace App\Services\User;

use App\Exceptions\Auth\CredendialsWrongException;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Interfaces\User\IUserFind;
use App\Http\Interfaces\User\IUserRegister;
use App\Http\Interfaces\User\IUserLogin;
use App\Http\Interfaces\User\IUserLogout;
use App\Http\Interfaces\User\IUserActive;
use App\Http\Interfaces\User\IUserUpdate;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserRegister, IUserLogin, IUserLogout, IUserActive, IUserUpdate
{
    private IUserFind $userFind;

    /**
     * @param IUserFind $userFind
     */
    public function __construct(IUserFind $userFind)
    {
        $this->userFind = $userFind;
    }

    /**
     * @param int $id
     * @return bool
     */
    function enable(int $id): bool
    {
        return User::withTrashed()->find($id)->restore();
    }

    /**
     * @param int $id
     * @return bool
     */
    function disable(int $id): bool
    {
        return User::withTrashed()->find($id)->delete();
    }


    /**
     * @param string $email
     * @param string $password
     * @return array
     * @throws CredendialsWrongException
     */
    function login(string $email, string $password): array
    {
        $user = $this->userFind->findLogin($email);

        if(!$user || !Hash::check($password, $user->password)){
            throw new CredendialsWrongException();
        }
        $token = $user->createToken("student")->plainTextToken;
        return ['user' => $user, 'token' => $token];
    }

    /**
     * @return bool
     */
    function singleLogout(): bool
    {
        return Auth::user()->currentAccessToken()->delete();
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return array
     */
    function register(string $name, string $email, string $password): array
    {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
        $token = $user->createToken(env('APP_KEY'))->plainTextToken;
        return [
            'user' => User::with('permissions')->find($user->id),
            'token' => $token,
        ];
    }


    /**
     * @param int $id
     * @param string $name
     * @param string $email
     * @return int
     * @throws UserNotFoundException
     */
    function update(int $id, string $name, string $email): int
    {
        $user = $this->userFind->find($id);
        if(empty($user)){
            throw new UserNotFoundException();
        }
        if($user->email != $email){
            Arr::set($fields, 'email_verified_at', null);
        }
        return $user->update([
            'name' => $name,
            'email' => $email
        ]);
    }
}