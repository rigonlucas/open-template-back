<?php

namespace App\Http\Interfaces\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUserFindRepo
{
    function findLogin(string $email) : ?User;

    function allUserPaginate (): LengthAwarePaginator;

    function find(int $id) : ?User;

    function findWithAll(int $id) : ?Collection;
}
