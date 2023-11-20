<?php

namespace App\Http\Controllers\API\V1;

use App\DTO\Category\LoginDTO;
use App\DTO\User\CreateUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\User\UserResource;
use App\Services\AuthService;

class AuthController extends Controller
{

    public function __construct(
        private readonly AuthService $authService
    ) {
    }

    public function login(LoginRequest $request)
    {
        try {
            $dto = new LoginDTO($request->validated());
            $data = $this->authService->login($dto);

            return response()->success(
                "auth.success.authorized",
                new LoginResource($data),
            );
        } catch (\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    public function register(CreateUserRequest $request)
    {
        try {
            $dto = new CreateUserDTO($request->validated());
            $data = $this->authService->register($dto);

            return response()->success(
                "auth.success.authenticated",
                new UserResource($data),
            );
        } catch (\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }
}
