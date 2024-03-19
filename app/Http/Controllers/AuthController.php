<?php

namespace App\Http\Controllers;

use App\Exceptions\AppError;
use App\Services\LoginServices\LoginService;
use App\Validators\LoginValidator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = LoginValidator::validate($request->all());

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $loginService = new LoginService();

            return $loginService->execute($request->all());
        } catch (AppError $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
}
