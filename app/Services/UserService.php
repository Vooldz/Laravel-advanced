<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data): User
    {

        // Protecting the password by hashing it.
        $data['password'] = Hash::make($data['password']);

        // Create then return the user
        $user = User::create($data);

        return $user;
    }
}
