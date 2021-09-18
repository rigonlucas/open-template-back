<?php

namespace App\Http\Interfaces\Rate;

use App\Models\Rate;

interface IRateStore
{
    function store(string $text, int $rate_points) : Rate;
}
