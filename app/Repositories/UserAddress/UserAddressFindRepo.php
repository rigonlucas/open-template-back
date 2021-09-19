<?php
namespace App\Repositories\UserAddress;

use App\Http\Interfaces\UserAddress\IUserAddressFindRepo;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserAddressFindRepo implements IUserAddressFindRepo
{

    /**
     * @param int $user_id
     * @return Collection
     */
    function findUserAddress(int $user_id): Collection
    {
        return UserAddress::where('user_id', $user_id)->get();
    }

    /**
     * @param int $user_id
     * @return Collection
     */
    function findUserAddressWithTrashed(int $user_id): Collection
    {
        return UserAddress::withTrashed()->where('user_id', $user_id)->get();
    }

    /**
     * @return UserAddress|null
     */
    function findAddressAuthById(): ?UserAddress
    {
        return UserAddress::where('user_id', Auth::id())->firstOrFail();
    }

    /**
     * @param string $hash
     * @return UserAddress|null
     */
    function findAddressAuthByHash(string $hash): ?UserAddress
    {
        return UserAddress::where('hash', $hash)->firstOrFail();
    }
}