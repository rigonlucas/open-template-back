<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\User\IUserFind;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private IUserFind $userFind;

    /**
     * @param IUserFind $userFind
     */
    public function __construct(IUserFind $userFind)
    {
        $this->userFind = $userFind;
    }

    /**
     * @return Response|Application|ResponseFactory
     */
    public function index(): Response|Application|ResponseFactory
    {
        try {
            return response($this->userFind->allUserPaginate());
        }catch (Exception $ex){
            return response($ex, 500);
        }
    }

}
