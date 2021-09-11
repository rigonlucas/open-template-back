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
     * @return Response|Application
     */
    public function store (RateStoreRequest $request): Response|Application
    {
        $fields = $request->validated();
        Arr::set($fields, 'user_id', Auth::id());

        try {
            $this->rateCheck->checkUserRate($fields['user_id']);
            $rate = $this->rateStore->store($fields);
            return response(ResponseDataBuilder::buildWithData("Avaliação realizada", $rate), 201);
        } catch (RateFoundException){
            return response(null,302);
        } catch (Exception $ex){
            return response($ex, 500);
        }
    }

    /**
     * @return Response|Application
     */
    public function checkRateUser(): Response|Application
    {
        return response(null, $this->rateCheck->checkUserRateResponse(Auth::id()));
    }
}
