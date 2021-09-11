<?php

namespace App\Repositories\Rate;

use App\Http\Interfaces\Rate\IRateStore;
use App\Models\Rate;

class RateStore implements IRateStore
{

    function store(array $fields): Rate
    {
        return Rate::create($fields);
    }
}
