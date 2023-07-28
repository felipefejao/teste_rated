<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use App\Services\UserService\Contract\UserServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class UpdateUserController extends Controller
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
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'email' =>'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $updated = $this->userService->updateUser($userId, $validator->valid());
            if (! $updated) {
                return response()->json(['message' => 'Could not update user'], 500);
            }

            return response()->json(['message' => 'User updated successfully'], 200);
        } catch (Throwable $throwable) {
            return response()->json($throwable->getMessage(), 500);
        }
    }
}
