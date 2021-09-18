<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserContact;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserContactPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param UserContact $userContact
     * @return bool
     */
    public function view(User $user, UserContact $userContact): bool
    {
        return $user->id === $userContact->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function store(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param UserContact $userContact
     * @return bool
     */
    public function update(User $user, UserContact $userContact): bool
    {
        return $user->id === $userContact->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param UserContact $userContact
     * @return bool
     */
    public function delete(User $user, UserContact $userContact): bool
    {
        return $user->id === $userContact->user_id && $user->email !== $userContact->contact;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param UserContact $userContact
     * @return bool
     */
    public function restore(User $user, UserContact $userContact): bool
    {
        return $user->id === $userContact->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param UserContact $userContact
     * @return bool
     */
    public function forceDelete(User $user, UserContact $userContact): bool
    {
        return $user->id === $userContact->user_id && $user->email !== $userContact->contact;
    }
}
