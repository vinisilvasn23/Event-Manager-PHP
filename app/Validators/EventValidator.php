<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class EventValidator
{
    public static function validate(array $data, $update = false)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|date_format:Y-m-d',
            'hour' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
        ];

        if ($update) {
            foreach ($rules as $field => &$rule) {
                $rule = str_replace('required|', '', $rule);
            }
        }

        return Validator::make($data, $rules);
    }
}
