<?php
namespace App\Http\Interfaces\UserAddress;

use App\Models\UserAddress;

interface IUserAddressStore
{
    function store (int $user_id, string $postal_code, string $address, int $number, string $complement, string $reference): UserAddress;
}