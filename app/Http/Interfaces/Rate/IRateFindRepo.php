<?php

namespace App\Http\Interfaces\Rate;

use Illuminate\Support\Collection;

interface IRateFindRepo
{
    function findUserRateByUserId(int $user_id) : Collection;
}
