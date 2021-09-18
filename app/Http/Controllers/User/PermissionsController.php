<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\UserPermission\IUserPermissionService;
use App\Http\Interfaces\UserPermission\IUserPermissionStore;
use App\Http\Requests\UserPermissions\StorePermissionRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    private IUserPermissionStore $permissionStore;

    /**
     * @param IUserPermissionStore $permissionStore
     */
    public function __construct(IUserPermissionStore $permissionStore)
    {
        $this->permissionStore = $permissionStore;
    }

    /**
     * @param StorePermissionRequest $request
     * @return JsonResponse
     */
    public function store (StorePermissionRequest $request): JsonResponse
    {
        try {
            $fields = $request->validated();
            return response()->json([$this->permissionStore->store($fields['user_id'], $fields['permission'])]);
        }catch (Exception $ex){
            return response()->json([$ex], 500);
        }
    }
}
