<?php

namespace App\Http\Controllers\User;

use App\Exceptions\User\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\User\IUserFind;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\User\IUserUpdateService;
use Exception;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private IUserFind $userFind;
    private IUserUpdateService $userUpdateService;

    /**
     * @param IUserFind $userFind
     * @param IUserUpdateService $userUpdateService
     */
    public function __construct(IUserFind $userFind, IUserUpdateService $userUpdateService)
    {
        $this->userFind = $userFind;
        $this->userUpdateService = $userUpdateService;
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

}
