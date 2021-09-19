<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserAddressPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param UserAddress $userAddress
     * @return Response
     */
    public function view(User $user, UserAddress $userAddress): Response
    {
        return $user->id === $userAddress->user_id  ? Response::allow() : Response::deny('Unauthorized', 401);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return void
     */
    public function store(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param UserAddress $userAddress
     * @return Response
     */
    public function update(User $user, UserAddress $userAddress): Response
    {
        return $user->id === $userAddress->user_id ? Response::allow() : Response::deny('Unauthorized', 401);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param UserAddress $userAddress
     * @return Response
     */
    public function delete(User $user, UserAddress $userAddress): Response
    {
        return $user->id === $userAddress->user_id ? Response::allow() : Response::deny('Unauthorized', 401);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param UserAddress $userAddress
     * @return Response
     */
    public function restore(User $user, UserAddress $userAddress): Response
    {
        return $user->id === $userAddress->user_id ? Response::allow() : Response::deny('Unauthorized', 401);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param UserAddress $userAddress
     * @return Response
     */
    public function forceDelete(User $user, UserAddress $userAddress): Response
    {
        return $user->id === $userAddress->user_id ? Response::allow() : Response::deny('Unauthorized', 401);
    }
}
