<?php
namespace App\Http\Interfaces\UserAddress;
interface IUserAddressDelete
{
    function delete (string $hash) : bool;

    function restore (string $hash) : bool;

    function forceDelete (string $hash) : bool;
}