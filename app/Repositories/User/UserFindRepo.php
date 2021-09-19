<?php

namespace App\Repositories\User;

use App\Http\Interfaces\User\IUserFindRepo;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserFindRepo implements IUserFindRepo
{

    /**
     * @param string $email
     * @return User|null
     */
    function findLogin(string $email): ? User
    {
        return User::where('email', $email)->with(['permissions'])->first();
    }

    /**
     * @return LengthAwarePaginator
     */
    function allUserPaginate(): LengthAwarePaginator
    {
        return User::latest()->with(['permissions'])->paginate(20);
    }

    /**
     * @param int $id
     * @return User|null
     */
    function find(int $id): ? User
    {
        return User::find($id);
    }

    /**
     * @param int $id
     * @return Collection|null
     */
    function findWithAll(int $id) : ?Collection
    {
        return User::withTrashed()->where('id', $id)->with(['permissions', 'rates'])->get();
    }
}
