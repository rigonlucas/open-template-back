<?php

namespace App\Http\Interfaces\Rate;

use App\Models\Rate;

interface IRateStore
{
    function store(Array $fields) : Rate;
}
