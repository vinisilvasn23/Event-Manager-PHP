<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class UserValidator
{
    public static function validate(array $data, $update = false)
    {
        $rules = [
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'password' => 'required|min:7|regex:/[a-zA-Z]/i',
        ];

        if ($update) {
            foreach ($rules as $field => &$rule) {
                $rule = str_replace('required|', '', $rule);
            }
        }

        return Validator::make($data, $rules);
    }
}
