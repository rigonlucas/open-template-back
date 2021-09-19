<?php
namespace App\Http\Interfaces\UserAddress;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Collection;

interface IUserAddressFindRepo
{
    function findUserAddress(int $user_id): Collection;

    function findUserAddressWithTrashed(int $user_id): Collection;

    function  findAddressAuthById(): ?UserAddress;

    function  findAddressAuthByHash(string $hash): ?UserAddress;

}