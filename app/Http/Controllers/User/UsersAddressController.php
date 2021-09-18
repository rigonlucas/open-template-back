<?php

namespace App\Http\Controllers\User;

use App\Exceptions\UserAddress\UserAddressNotFoundException;
use App\Helpers\ResponseDataBuilder;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\UserAddress\IUserAddressDelete;
use App\Http\Interfaces\UserAddress\IUserAddressFind;
use App\Http\Interfaces\UserAddress\IUserAddressStore;
use App\Http\Interfaces\UserAddress\IUserAddressUpdate;
use App\Http\Requests\UserAdrress\StoreUserAdrresRequest;
use App\Http\Requests\UserAdrress\UpdateUserAdrresRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class UsersAddressController extends Controller
{

    private IUserAddressFind $userAddressFind;
    private IUserAddressStore $userAddressStore;
    private IUserAddressUpdate $userAddressUpdate;
    private IUserAddressDelete $userAddressDelete;

    public function __construct(IUserAddressFind $userAddressFind, IUserAddressStore $userAddressStore, IUserAddressUpdate $userAddressUpdate, IUserAddressDelete $userAddressDelete)
    {
        $this->userAddressFind = $userAddressFind;
        $this->userAddressStore = $userAddressStore;
        $this->userAddressUpdate = $userAddressUpdate;
        $this->userAddressDelete = $userAddressDelete;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json($this->userAddressFind->findAddressAuthById());
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
            $fields = $request->validated();
            return response()->json([$this->userAddressStore->store(
                    $fields['postal_code'],
                    $fields['address'],
                    $fields['number'],
                    $fields['complement'],
                    $fields['reference'])], 201);
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
            $fields = $request->validated();
            return response()->json($this->userAddressUpdate->update(
                    $fields['postal_code'],
                    $fields['address'],
                    $fields['number'],
                    $fields['complement'],
                    $fields['reference'], $hash), 200);
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
            return response()->json(ResponseDataBuilder::buildWithData('Endereço arquivado', $this->userAddressDelete->delete($hash)), 200);
        }catch (UserAddressNotFoundException){
            return response()->json(null, 204);
        }catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  string  $hash
     * @return JsonResponse
     */
    public function restore(string $hash): JsonResponse
    {
        try {
            return response()->json(ResponseDataBuilder::buildWithData('Endereço restaurado', $this->userAddressDelete->delete($hash)), 200);
        }catch (UserAddressNotFoundException){
            return response()->json(null, 204);
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
    public function forceDelete(string $hash): JsonResponse
    {
        try {
            return response()->json($this->userAddressDelete->forceDelete($hash), 204);
        }catch (UserAddressNotFoundException){
            return response()->json(null, 204);
        }catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }
}
