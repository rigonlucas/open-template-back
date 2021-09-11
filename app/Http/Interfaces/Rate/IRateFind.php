<?php

namespace App\Http\Interfaces\Rate;

use Illuminate\Support\Collection;

interface IRateFind
{
    function findUserRate(int $user_id) : Collection;
}
