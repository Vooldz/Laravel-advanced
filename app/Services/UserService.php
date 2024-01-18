<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\V1\BaseController;

class UserService extends BaseController
{
    public function createUser(array $data): User
    {
        // Protecting the password by hashing it.
        $data['password'] = Hash::make($data['password']);

        // Create then return the user
        $user = User::create($data);

        return $user;
    }
    public function loginUser(Request $request)
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
