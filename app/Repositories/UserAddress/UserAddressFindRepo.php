<?php
namespace App\Repositories\UserAddress;

use App\Http\Interfaces\UserAddress\IUserAddressFind;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserAddressFindRepo implements IUserAddressFind
{

    function findUserAddress(int $user_id): Collection
    {
        // TODO: Implement findUserAddress() method.
    }

    function findUserAddressWithTrashed(int $user_id): Collection
    {
        // TODO: Implement findUserAddressWithTrashed() method.
    }

    function findAddressAuthById(): ?UserAddress
    {
        return UserAddress::where('user_id', Auth::id())->firstOrFail();
    }

    function findAddressAuthByHash(string $hash): ?UserAddress
    {
        return UserAddress::where('hash', $hash)->firstOrFail();
    }
}