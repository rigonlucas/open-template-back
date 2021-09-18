<?php

namespace App\Http\Interfaces\UserContact;

use App\Models\UserContact;
use Illuminate\Database\Eloquent\Collection;

interface IUserContactFind
{
    function findContactsAuthByHash() : Collection;

    function findContactByHash(string $hash) : ?UserContact;
}