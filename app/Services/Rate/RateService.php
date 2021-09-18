<?php

namespace App\Services\Rate;

use App\Exceptions\Rate\RateFoundException;
use App\Http\Interfaces\Rate\IRateCheck;
use App\Http\Interfaces\Rate\IRateFind;
use App\Http\Interfaces\Rate\IRateStore;
use App\Models\Rate;
use Illuminate\Support\Facades\Auth;

class RateService implements IRateCheck, IRateStore
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

    function store(string $text, int $rate_points): Rate
    {
        return Rate::create([
            'text' => $text,
            'rate_points' => $rate_points,
            'user_id' => Auth::id()
        ]);
    }
}
