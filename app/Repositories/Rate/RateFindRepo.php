<?php

namespace App\Repositories\Rate;

use App\Http\Interfaces\Rate\IRateFindRepo;
use App\Models\Rate;
use Illuminate\Support\Collection;

class RateFindRepo implements IRateFindRepo
{

    /**
     * @param int $user_id
     * @return Collection
     */
    function findUserRateByUserId(int $user_id) : Collection
    {
        return Rate::where('user_id', $user_id)->get();
    }
}
