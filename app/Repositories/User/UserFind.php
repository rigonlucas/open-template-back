<?php

namespace App\Repositories\User;

use App\Http\Interfaces\User\IUserFind;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserFind implements IUserFind
{

    function findLogin(string $email): ?User
    {
        return User::where('email', $email)->with('permissions')->first();
    }

    function findUsersDoesHaveProcessoUserId(int $processo_id): LengthAwarePaginator
    {
        return User::whereDoesntHave('processoUser', function ($query) use($processo_id) {
            $query->where(['processo_id' => $processo_id]);
        })->paginate(10);
    }

    function allUserPaginate(): LengthAwarePaginator{
        return User::latest()->with(['permissions'])->paginate(20);
    }

    function find(int $id): ?User
    {
        return User::find($id);
    }
}
