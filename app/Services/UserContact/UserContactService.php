<?php

namespace App\Services\UserContact;

use App\Exceptions\UserContact\UserContactExistException;
use App\Exceptions\UserContact\UserContactNotFoundException;
use App\Http\Interfaces\UserContact\IUserContactDelete;
use App\Http\Interfaces\UserContact\IUserContactStore;
use App\Http\Interfaces\UserContact\IUserContactUpdate;
use App\Models\UserContact;
use Illuminate\Support\Facades\Auth;

class UserContactService implements IUserContactStore, IUserContactDelete, IUserContactUpdate
{
    public function __construct()
    {

    }

    /**
     * @param string $type
     * @param string $contact
     * @param string $description
     * @return UserContact
     * @throws UserContactExistException
     */
    function store(string $type, string $contact, string $description): UserContact
    {
        $userContac = UserContact::where('contact', $contact)->where('user_id', Auth::id())->first();
        if($userContac != null){
            throw new UserContactExistException();
        }
        return UserContact::create([
            'user_id' => Auth::id(),
            'type' => $type,
            'contact' => $contact,
            'description' => $description,
            'hash' => md5(Auth::id() . $contact . rand(0, 1500)),
        ]);
    }

    /**
     * @param string $type
     * @param string $contact
     * @param string $description
     * @param string $hash
     * @return int
     * @throws UserContactExistException
     */
    function update(string $type, string $contact, string $description, string $hash): int
    {
        $userContac = UserContact::where('contact', $contact)->where('hash', '!=',$hash)->first();
        if($userContac != null){
            throw new UserContactExistException();
        }
        return UserContact::where('hash', $hash)->update([
            'type' => $type,
            'contact' => $contact,
            'description' => $description,
        ]);
    }

    function delete(string $hash): bool
    {
        $userContact = UserContact::withTrashed()->where('hash', $hash)->first();
        if($userContact == null){
            throw new UserContactNotFoundException();
        }
        return $userContact->delete();
    }

    function restore(string $hash): bool
    {
        $userContact = UserContact::withTrashed()->where('hash', $hash)->first();
        if($userContact == null){
            throw new UserContactNotFoundException();
        }
        return $userContact->restore();
    }
    function forceDelete(string $hash): bool
    {
        $userContact = UserContact::withTrashed()->where('hash', $hash)->first();
        if($userContact == null){
            throw new UserContactNotFoundException();
        }
        return $userContact->forceDelete();
    }
}