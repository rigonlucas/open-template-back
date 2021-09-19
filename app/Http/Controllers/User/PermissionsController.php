<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\UserPermission\IUserPermissionDelete;
use App\Http\Interfaces\UserPermission\IUserPermissionStore;
use App\Http\Requests\UserPermissions\DeletePermissionRequest;
use App\Http\Requests\UserPermissions\StorePermissionRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class PermissionsController extends Controller
{
    private IUserPermissionStore $permissionStore;
    private IUserPermissionDelete $permissionDelete;

    /**
     * @param IUserPermissionStore $permissionStore
     * @param IUserPermissionDelete $permissionDelete
     */
    public function __construct(IUserPermissionStore $permissionStore, IUserPermissionDelete $permissionDelete)
    {
        $this->permissionStore = $permissionStore;
        $this->permissionDelete = $permissionDelete;
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
            return response()->json($ex, 500);
        }
    }

    /**
     * @param DeletePermissionRequest $request
     * @return JsonResponse
     */
    public function delete(DeletePermissionRequest $request): JsonResponse
    {
        try {
            $fields = $request->validated();
            return response()->json([$this->permissionDelete->delete($fields['id'], $fields['user_id'])], 204);
        }catch (Exception $ex){
            return response()->json($ex, 500);
        }
    }
}
