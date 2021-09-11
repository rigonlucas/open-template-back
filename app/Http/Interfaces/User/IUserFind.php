<?php

namespace App\Http\Interfaces\User;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUserFind
{
    function findLogin(string $email) : ?User;

    function  findUsersDoesHaveProcessoUserId (int $processo_id) : LengthAwarePaginator;

    function allUserPaginate (): LengthAwarePaginator;

    function find(int $id) : ?User;
}
