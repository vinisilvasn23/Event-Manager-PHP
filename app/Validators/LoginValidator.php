<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class LoginValidator
{
    public static function validate(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:7', 'regex:/[a-zA-Z]/i'],
        ]);
    }
}
