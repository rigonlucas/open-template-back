<?php

namespace App\Http\Interfaces\Rate;

use Illuminate\Support\Collection;

interface IRateFindRepo
{
    function findUserRate(int $user_id) : Collection;
}
