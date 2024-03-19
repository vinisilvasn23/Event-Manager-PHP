<?php

namespace App\Services\UserServices;

use App\Exceptions\AppError;
use App\Models\User;
use App\Validators\UserValidator;

class CreateUserService
{
    public function execute(array $data)
    {
        try {
            $validator = UserValidator::validate($data);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $userFound = User::where('email', $data['email'])->first();

            if (!is_null($userFound)) {
                throw new AppError('Already registered user!', 400);
            }

            $user = User::create($data);

            return $user;
        } catch (AppError $e) {
            throw $e;
        }
    }
}
