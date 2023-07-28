<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use App\Services\UserService\Contract\UserServiceContract;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class GetUserController extends Controller
{
    private $userService;

    public function __construct(UserServiceContract $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $userId)
    {
        try {
            $user = $this->userService->getUser($userId);
            if (!$user) {
                throw new Exception("Id Not Found", 404);
            }

            return response()->json($user);

        } catch (Throwable $throwable) {
            return response()->json([
                'errorCode' => $throwable->getCode(),
                'message' => $throwable->getMessage()
            ],404);
        }
    }
}
