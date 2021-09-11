<?php

namespace App\Http\Controllers\User;

use App\Exceptions\User\UserNotFoundException;
use App\Helpers\ResponseDataBuilder;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\User\IUserFind;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\User\IUserUpdateService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

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
    public function index ()
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
    public function update (UpdateUserRequest $request){
        try {
            return response()->json([$this->userUpdateService->update($request->validated())]);
        }catch (UserNotFoundException){
            return response()->json([null],204);
        }catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }

}
