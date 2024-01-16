<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\V1\BaseController;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\V1\Auth\LoginUserRequest;


class LoginController extends BaseController
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function login(LoginUserRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $message['token'] = $user->createToken($user->name)->plainTextToken;
            $message['name'] = $user->name;

            return $this->successResponse($message);
        } else {
            return $this->errorResponse('Invalid Credentials!');
        }
        
    }
}
