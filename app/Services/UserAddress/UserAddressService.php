<?php
namespace App\Services\UserAddress;

use App\Http\Interfaces\UserAddress\IUserAddressDelete;
use App\Http\Interfaces\UserAddress\IUserAddressStore;
use App\Http\Interfaces\UserAddress\IUserAddressUpdate;

class UserAddressService implements IUserAddressStore,IUserAddressUpdate, IUserAddressDelete
{

    function delete(string $hash): bool
    {
        // TODO: Implement delete() method.
    }

    function restore(string $hash): bool
    {
        // TODO: Implement restore() method.
    }

    function forceDelete(string $hash): bool
    {
        // TODO: Implement forceDelete() method.
    }

    function store(int $user_id, string $postal_code, string $address, int $number, string $complement, string $reference): \App\Models\UserAddress
    {
        // TODO: Implement store() method.
    }

    function update(int $user_id, string $postal_code, string $address, int $number, string $complement, string $reference, string $hash): int
    {
        // TODO: Implement update() method.
    }
}