<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use App\Services\UserService\Contract\UserServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AddUserController extends Controller
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

        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'email' =>'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $inserted = $this->userService->createUser($validator->valid());
            if (! $inserted) {
                return response()->json(['message' => 'Something went wrong'], 500);
            }

            return response()->json([
              'message' => 'Usuário criado com sucesso!'
            ], 201);
        } catch (Throwable $throwable) {
            return response()->json([
              'message' => $throwable->getMessage()
            ], 400);
        }
    }
}
