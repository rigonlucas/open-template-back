<?php

namespace App\Http\Interfaces\Rate;

interface IRateCheck
{
    function checkUserRateResponse (int $user_id) : int;

    function checkUserRate (int $user_id) : bool;
}
