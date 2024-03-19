<?php

namespace App\Services\LoginServices;

use App\Exceptions\AppError;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginService {
    public function execute(array $data) {
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            throw new AppError('User not found', 404);
        }

        if (!$token = JWTAuth::attempt($data)) {
            throw new AppError('Incorrect email or password', 401);
        }

        return [
            'token' => $token,
        ];
    }
}
