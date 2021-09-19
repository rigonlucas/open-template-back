<?php

namespace App\Http\Controllers\User;

use App\Exceptions\UserContact\UserContactExistException;
use App\Exceptions\UserContact\UserContactNotFoundException;
use App\Helpers\ResponseDataBuilder;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\UserContact\IUserContactDelete;
use App\Http\Interfaces\UserContact\IUserContactFindRepo;
use App\Http\Interfaces\UserContact\IUserContactStore;
use App\Http\Interfaces\UserContact\IUserContactUpdate;
use App\Http\Requests\UserContact\StoreUserContactRequest;
use App\Http\Requests\UserContact\UpdateUserContactRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class UserContactController extends Controller
{
    private IUserContactFindRepo $userContactFind;
    private IUserContactStore $userContactStore;
    private IUserContactDelete $userContactDelete;
    private IUserContactUpdate $userContactUpdate;

    /**
     * @param IUserContactFindRepo $userContactFind
     * @param IUserContactStore $userContactStore
     * @param IUserContactUpdate $userContactUpdate
     * @param IUserContactDelete $userContactDelete
     */
    public function __construct(IUserContactFindRepo $userContactFind, IUserContactStore $userContactStore, IUserContactUpdate $userContactUpdate, IUserContactDelete $userContactDelete)
    {
        $this->userContactFind = $userContactFind;
        $this->userContactStore = $userContactStore;
        $this->userContactUpdate = $userContactUpdate;
        $this->userContactDelete = $userContactDelete;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json($this->userContactFind->findContactsAuthByHash());
        }catch (Exception $ex){
            return response()->json($ex, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserContactRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserContactRequest $request): JsonResponse
    {
        try {
            $fields = $request->validated();
            return response()->json($this->userContactStore->store($fields['type'], $fields['contact'], $fields['description']));
        }catch (UserContactExistException){
            return response()->json(null, 302);
        } catch (Exception $ex){
            return response()->json($ex, 500);
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
            return response()->json($this->userContactFind->findContactByHash($hash));
        }catch (UserContactNotFoundException){
            return response()->json(ResponseDataBuilder::buildWithoutData('Contato não encontrado'), 404);
        } catch (Exception $ex){
            return response()->json($ex, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserContactRequest $request
     * @param string $hash
     * @return JsonResponse
     */
    public function update(UpdateUserContactRequest $request, string $hash): JsonResponse
    {
        try {
            $fields = $request->validated();
            return response()->json($this->userContactUpdate->update($fields['type'], $fields['contact'], $fields['description'], $hash));
        }
        catch (UserContactExistException){
            return response()->json(null, 302);
        }catch (Exception $ex){
            return response()->json($ex, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $hash
     * @return JsonResponse
     */
    public function delete(string $hash): JsonResponse
    {
        try {
            return response()->json(ResponseDataBuilder::buildWithData('Contato arquivado', $this->userContactDelete->delete($hash)));
        }catch (UserContactNotFoundException){
            return response()->json(ResponseDataBuilder::buildWithoutData('Contato não encontrado'), 404);
        }catch (Exception $ex){
            return response()->json($ex, 500);
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param string $hash
     * @return JsonResponse
     */
    public function restore(string $hash): JsonResponse
    {
        try {
            return response()->json(ResponseDataBuilder::buildWithData('Contato restaurado', $this->userContactDelete->restore($hash)));
        }catch (UserContactNotFoundException){
            return response()->json(ResponseDataBuilder::buildWithoutData('Contato não encontrado'), 404);
        }catch (Exception $ex){
            return response()->json($ex, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $hash
     * @return JsonResponse
     */
    public function forceDelete(string $hash): JsonResponse
    {
        try {
            return response()->json(ResponseDataBuilder::buildWithData('Contato excluído definitivamente', $this->userContactDelete->forceDelete($hash)));
        }catch (UserContactNotFoundException){
            return response()->json(ResponseDataBuilder::buildWithoutData('Contato não encontrado'), 404);
        }catch (Exception $ex){
            return response()->json($ex, 500);
        }
    }
}
