<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\UserAddress\IUserAddressFind;
use App\Http\Requests\UserAdrress\StoreUserAdrresRequest;
use App\Http\Requests\UserAdrress\UpdateUserAdrresRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class UsersAddressController extends Controller
{

    private IUserAddressFind $userAddressFind;

    public function __construct(IUserAddressFind $userAddressFind)
    {
        $this->userAddressFind = $userAddressFind;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json(['ok']);
        }catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserAdrresRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserAdrresRequest $request): JsonResponse
    {
        try {
            return response()->json([$request]);
        }catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $hash
     * @return JsonResponse
     */
    public function show(string $hash): JsonResponse
    {
        try {
            return response()->json([$this->userAddressFind->findAddressAuthByHash($hash)]);
        }catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserAdrresRequest $request
     * @param string $hash
     * @return JsonResponse
     */
    public function update(UpdateUserAdrresRequest $request, string $hash): JsonResponse
    {
        try {
            return response()->json([$request, $hash]);
        }catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $hash
     * @return JsonResponse
     */
    public function delete(string $hash): JsonResponse
    {
        try {
            return response()->json([$hash]);
        }catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $hash
     * @return JsonResponse
     */
    public function foreceDelete(string $hash)
    {
        try {
            return response()->json([$hash]);
        }catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }
}
