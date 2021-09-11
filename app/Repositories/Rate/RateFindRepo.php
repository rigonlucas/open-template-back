<?php

namespace App\Repositories\Rate;

use App\Http\Interfaces\Rate\IRateFind;
use App\Models\Rate;
use Illuminate\Support\Collection;

class RateFindRepo implements IRateFind
{

    function findUserRate(int $user_id) : Collection
    {
        return Rate::where('user_id', $user_id)->get();
    }
}
