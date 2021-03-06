<?php
namespace App\Services\UserAddress;

use App\Exceptions\UserAddress\UserAddressNotFoundException;
use App\Http\Interfaces\UserAddress\IUserAddressDelete;
use App\Http\Interfaces\UserAddress\IUserAddressStore;
use App\Http\Interfaces\UserAddress\IUserAddressUpdate;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserAddressService implements IUserAddressStore,IUserAddressUpdate, IUserAddressDelete
{

    /**
     * Store new user address
     * @param string $postal_code
     * @param string $address
     * @param int $number
     * @param string $complement
     * @param string $reference
     * @return UserAddress
     */
    function store(string $postal_code, string $address, int $number, string $complement, string $reference): UserAddress
    {
        return UserAddress::create([
            'postal_code' => $postal_code,
            'address' => $address,
            'number' => $number,
            'complement' => $complement,
            'reference' => $reference,
            'user_id' => Auth::id(),
            'hash' => md5(Auth::id() . $postal_code . $address . $number . rand(0, 15000))
        ]);
    }

    /**
     * Update user address by hash code
     * @param string $postal_code
     * @param string $address
     * @param int $number
     * @param string $complement
     * @param string $reference
     * @param string $hash
     * @return int
     */
    function update(string $postal_code, string $address, int $number, string $complement, string $reference, string $hash): int
    {
        $userAddress = UserAddress::withTrashed()->where('hash', $hash)->first();
        Gate::authorize('update', $userAddress);
        return $userAddress->update([
            'postal_code' => $postal_code,
            'address' => $address,
            'number' => $number,
            'complement' => $complement,
            'reference' => $reference,
            'user_id' => Auth::id(),
        ]);
    }

    /**
     * Softdelete of an user address
     * @param string $hash
     * @return bool
     * @throws UserAddressNotFoundException
     */
    function delete(string $hash): bool
    {
        $userAddress = UserAddress::where('hash', $hash)->first();
        if($userAddress == null){
            throw new UserAddressNotFoundException();
        }
        Gate::authorize('delete', $userAddress);
        return $userAddress->delete();
    }

    /**
     * Restore Softdelete of an user address
     * @param string $hash
     * @return bool
     * @throws UserAddressNotFoundException
     */
    function restore(string $hash): bool
    {
        $userAddress = UserAddress::withTrashed()->where('hash', $hash)->first();
        if($userAddress == null){
            throw new UserAddressNotFoundException();
        }
        Gate::authorize('restore', $userAddress);
        return $userAddress->restore();
    }

    /**
     * Force delete user address
     * @param string $hash
     * @return bool
     * @throws UserAddressNotFoundException
     */
    function forceDelete(string $hash): bool
    {
        $userAddress = UserAddress::withTrashed()->where('hash', $hash)->first();
        if($userAddress == null){
            throw new UserAddressNotFoundException();
        }
        Gate::authorize('forceDelete', $userAddress);
        return $userAddress->forceDelete();
    }

}