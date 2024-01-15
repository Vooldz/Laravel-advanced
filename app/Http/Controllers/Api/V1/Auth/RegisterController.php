<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;
class RegisterController extends BaseController
{
    public UserService $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    // Register
    public function register(RegisterUserRequest $request)
    {
        // Create the user.
        $user = $this->userService->createUser($request->all());

        // Prepare the message to return it with the json code.
        $message['user'] = $user;
        $message['token'] = $user->createToken($user->name)->plainTextToken;

        // Return a json code with these messages.
        return $this->successResponse([$message]);
    }
}
