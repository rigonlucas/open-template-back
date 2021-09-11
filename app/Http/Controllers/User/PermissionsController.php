<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\UserPermission\IUserPermissionService;
use App\Http\Requests\UserPermissions\StorePermissionRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    private IUserPermissionService $userPermissionService;

    /**
     * @param IUserPermissionService $userPermissionService
     */
    public function __construct(IUserPermissionService $userPermissionService)
    {
        $this->userPermissionService = $userPermissionService;
    }

    /**
     * @param StorePermissionRequest $request
     * @return JsonResponse
     */
    public function store (StorePermissionRequest $request): JsonResponse
    {
        try {
            return response()->json([$this->userPermissionService->store($request->validated())]);
        }catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }
}
