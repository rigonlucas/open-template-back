<?php

namespace App\Repositories\User;

use App\Http\Interfaces\User\IUserFind;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserFindRepo implements IUserFind
{

    function findLogin(string $email): ? User
    {
        return User::where('email', $email)->with(['permissions'])->first();
    }

    function allUserPaginate(): LengthAwarePaginator
    {
        return User::latest()->with(['permissions'])->paginate(20);
    }

    function find(int $id): ? User
    {
        return User::find($id);
    }

    function findWithAll(int $id) : ?Collection
    {
        return User::withTrashed()->where('id', $id)->with(['permissions', 'rates'])->get();
    }
}
