<?php

namespace App\Services\UserServices;

use App\Exceptions\AppError;
use App\Models\User;

class DeleteUserService
{
    public function execute($id)
    {
        $user = User::find($id);

        if (!$user) {
            throw new AppError('User not found', 404);
        }

        $user->delete();

        return response()->json([], 204);
    }
}
