<?php

namespace App\Http\Controllers\User;

use App\Exceptions\User\UserNotFoundException;
use App\Helpers\ResponseDataBuilder;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\User\IUserActive;
use App\Http\Interfaces\User\IUserFind;
use App\Http\Interfaces\User\IUserUpdate;
use App\Http\Requests\User\DisableUserRequest;
use App\Http\Requests\User\EnableUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private IUserFind $userFind;
    private IUserUpdate $userUpdate;
    private IUserActive $userActive;

    /**
     * @param IUserFind $userFind
     * @param IUserUpdate $userUpdate
     * @param IUserActive $userActive
     */
    public function __construct(IUserFind $userFind, IUserUpdate $userUpdate, IUserActive $userActive)
    {
        $this->userFind = $userFind;
        $this->userUpdate = $userUpdate;
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
            return response()->json($ex, 500);
        }
    }


    /**
     * @param int $user_id
     * @return JsonResponse
     */
    public function show (int $user_id): JsonResponse
    {
        try {
            return response()->json($this->userFind->findWithAll($user_id));
        }catch (Exception $ex){
            return response()->json($ex, 500);
        }
    }

    /**
     * @param UpdateUserRequest $request
     * @return JsonResponse
     */
    public function update (UpdateUserRequest $request): JsonResponse
    {
        try {
            $fields = $request->validated();
            return response()->json([$this->userUpdate->update($fields['id'] ,$fields['name'], $fields['email'])]);
        }catch (UserNotFoundException){
            return response()->json([null],204);
        }catch (Exception $ex){
            return response()->json($ex, 500);
        }
    }

    /**
     * @param DisableUserRequest $request
     * @return JsonResponse
     */
    public function disable (DisableUserRequest $request): JsonResponse
    {
        try {
            $fields = $request->validated();
            $this->userActive->disable($fields['id']);
            return response()->json(ResponseDataBuilder::buildWithoutData("Usuário inativo"));
        }catch (Exception $ex){
            return response()->json($ex, 500);
        }
    }

    /**
     * @param EnableUserRequest $request
     * @return JsonResponse
     */
    public function enable (EnableUserRequest $request): JsonResponse
    {
        try {
            $fields = $request->validated();
            $this->userActive->enable($fields['id']);
            return response()->json(ResponseDataBuilder::buildWithoutData("Usuário ativo"));
        }catch (Exception $ex){
            return response()->json($ex, 500);
        }
    }

}
