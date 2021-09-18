<?php

namespace App\Repositories\UserContact;

use App\Exceptions\UserContact\UserContactNotFoundException;
use App\Http\Interfaces\UserContact\IUserContactFind;
use App\Models\UserContact;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserContactFind implements IUserContactFind
{

    /**
     * @return Collection
     */
    function findContactsAuthByHash(): Collection
    {
        return UserContact::where('user_id', Auth::id())->get();
    }

    /**
     * @param string $hash
     * @return UserContact
     */
    function findContactByHash(string $hash): ?UserContact
    {
        $userContact = UserContact::where('hash', $hash)->first();
        if($userContact == null){
            throw new UserContactNotFoundException();
        }
        return $userContact;
    }

}