<?php

namespace App\Http\Interfaces\UserContact;

interface IUserContactUpdate
{
    function update (string $type, string $contact, string $description, string $hash): int;
}