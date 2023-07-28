<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use App\Services\UserService\Contract\UserServiceContract;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class GetAllUsersController extends Controller
{
    private $userService;

    public function __construct(UserServiceContract $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try{
            $users = $this->userService->getAllUsers();
            if (!$users) {
                throw new Exception("No users were found", 404);
            }

            return response()->json($users, 200);

        } catch (Throwable $throwable) {
            return response()->json([
                'errorCode' => $throwable->getCode(),
                'message' => $throwable->getMessage()
            ], 400);
        }
    }
}
