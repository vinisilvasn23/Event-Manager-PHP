<?php

namespace App\Services\UserServices;

use App\Models\User;

class GetUserService
{
    public function execute($id = null)
    {
        if ($id === null) {
            return User::all();
        }

        return User::findOrFail($id);
    }
}
