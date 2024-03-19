<?php

namespace App\Services\UserServices;

use App\Exceptions\AppError;
use App\Models\User;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\Hash;

class UpdateUserService
{
    public function execute($id, array $data)
    {
        $user = User::find($id);

        if (!$user) {
            throw new AppError('User not found', 404);
        }

        $validator = UserValidator::validate($data, true);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (isset($data['email']) && $data['email'] !== $user->email) {
            $existingUser = User::where('email', $data['email'])->first();

            if ($existingUser) {
                throw new AppError('Email already exists', 400);
            }
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return $user;
    }
}
