<?php
namespace App\Http\Interfaces\UserAddress;

interface IUserAddressUpdate
{
    function update (int $user_id, string $postal_code, string $address, int $number, string $complement, string $reference, string $hash) : int;
}