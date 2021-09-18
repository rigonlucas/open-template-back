<?php

namespace App\Http\Interfaces\UserContact;

use App\Models\UserContact;

interface IUserContactStore
{
    function store (string $type, string $contact, string $description): UserContact;
}