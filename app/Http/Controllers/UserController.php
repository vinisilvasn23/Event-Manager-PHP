<?php

namespace App\Http\Controllers;

use App\Services\UserServices\CreateUserService;
use App\Services\UserServices\GetUserService;
use App\Services\UserServices\UpdateUserService;
use App\Services\UserServices\DeleteUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $createUserService;
    protected $getUserService;
    protected $updateUserService;
    protected $deleteUserService;

    public function __construct(
        CreateUserService $createUserService,
        GetUserService $getUserService,
        UpdateUserService $updateUserService,
        DeleteUserService $deleteUserService
    ) {
        $this->createUserService = $createUserService;
        $this->getUserService = $getUserService;
        $this->updateUserService = $updateUserService;
        $this->deleteUserService = $deleteUserService;
    }

    public function create(Request $request)
    {
        return $this->createUserService->execute($request->all());
    }
    public function getUser()
    {
        return $this->getUserService->execute();
    }

    public function updateUser(Request $request, $id)
    {
        return $this->updateUserService->execute($id, $request->all());
    }

    public function deleteUser($id)
    {
        return $this->deleteUserService->execute($id);
    }

    public function getUserById($id)
    {
        return $this->getUserService->execute($id);
    }
}
