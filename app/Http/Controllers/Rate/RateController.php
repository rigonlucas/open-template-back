<?php

namespace App\Http\Controllers\Rate;

use App\Exceptions\Rate\RateFoundException;
use App\Helpers\ResponseDataBuilder;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Rate\IRateCheck;
use App\Http\Interfaces\Rate\IRateStore;
use App\Http\Requests\Rate\RateStoreRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    private IRateStore $rateStore;
    private IRateCheck $rateCheck;

    public function __construct(IRateStore $rateStore, IRateCheck $rateCheck)
    {
        $this->rateStore = $rateStore;
        $this->rateCheck = $rateCheck;
    }

    /**
     * @param RateStoreRequest $request
     * @return JsonResponse
     */
    public function store (RateStoreRequest $request)
    {
        $fields = $request->validated();
        Arr::set($fields, 'user_id', Auth::id());

        try {
            $this->rateCheck->checkUserRate($fields['user_id']);
            $rate = $this->rateStore->store($fields);
            return response()->json(ResponseDataBuilder::buildWithData("Avaliação realizada", $rate), 201);
        } catch (RateFoundException){
            return response()->json(null,302);
        } catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }

    /**
     * @return JsonResponse
     */
    public function checkRateUser(): JsonResponse
    {
        try {
            return response()->json(null, $this->rateCheck->checkUserRateResponse(Auth::id()));
        }catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }
}
