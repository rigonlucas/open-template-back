<?php

namespace App\Http\Interfaces\UserContact;

interface IUserContactDelete
{
    function delete (string $hash) : bool;

    function restore (string $hash) : bool;

    function forceDelete (string $hash) : bool;
}