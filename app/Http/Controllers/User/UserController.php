<?php

namespace App\Http\Controllers\User;

use App\Exceptions\User\UserNotFoundException;
use App\Helpers\ResponseDataBuilder;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\User\IUserActive;
use App\Http\Interfaces\User\IUserFind;
use App\Http\Interfaces\User\IUserUpdateService;
use App\Http\Requests\User\DisableUserRequest;
use App\Http\Requests\User\EnableUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private IUserFind $userFind;
    private IUserUpdateService $userUpdateService;
    private IUserActive $userActive;

    /**
     * @param IUserFind $userFind
     * @param IUserUpdateService $userUpdateService
     */
    public function __construct(IUserFind $userFind, IUserUpdateService $userUpdateService, IUserActive $userActive)
    {
        $this->userFind = $userFind;
        $this->userUpdateService = $userUpdateService;
        $this->userActive = $userActive;
    }


    /**
     * @return JsonResponse
     */
    public function index (): JsonResponse
    {
        try {
            return response()->json($this->userFind->allUserPaginate());
        }catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }

    /**
     * @param UpdateUserRequest $request
     * @return JsonResponse
     */
    public function update (UpdateUserRequest $request): JsonResponse
    {
        try {
            return response()->json([$this->userUpdateService->update($request->validated())]);
        }catch (UserNotFoundException){
            return response()->json([null],204);
        }catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }

    /**
     * @param DisableUserRequest $request
     * @return JsonResponse
     */
    public function disable (DisableUserRequest $request): JsonResponse
    {
        try {
            $this->userActive->disable($request->validated());
            return response()->json(ResponseDataBuilder::buildWithoutData("Usuário inativo"));
        }catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }

    /**
     * @param EnableUserRequest $request
     * @return JsonResponse
     */
    public function enable (EnableUserRequest $request): JsonResponse
    {
        try {
            $this->userActive->enable($request->validated());
            return response()->json(ResponseDataBuilder::buildWithoutData("Usuário ativo"));
        }catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }

}
