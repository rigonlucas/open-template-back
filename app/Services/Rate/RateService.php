<?php

namespace App\Services\Rate;

use App\Exceptions\Rate\RateFoundException;
use App\Http\Interfaces\Rate\IRateCheck;
use App\Http\Interfaces\Rate\IRateFind;

class RateService implements IRateCheck
{
    private IRateFind $rateFind;

    public function __construct(IRateFind $rateFind)
    {
        $this->rateFind = $rateFind;
    }

    function checkUserRateResponse(int $user_id): int
    {
        $rateCount = $this->rateFind->findUserRate($user_id)->count();
        if($rateCount > 0){
            return 302;
        }else{
            return 204;
        }
    }

    function checkUserRate(int $user_id): bool
    {
        $rateCount = $this->rateFind->findUserRate($user_id)->count();
        if($rateCount > 0){
            throw new RateFoundException();
        }
        return true;
    }
}
