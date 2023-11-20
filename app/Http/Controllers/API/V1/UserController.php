<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;

use App\Services\Interfaces\UserServiceInterface;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UsersResource;
use App\DTO\User\CreateUserDTO;
use App\DTO\User\UpdateUserDTO;

class UserController extends Controller
{
    public function __construct(
        protected readonly UserServiceInterface $UserService,
    ){
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $data = $this->UserService->getAllUsers();

            return response()->success(
                "user.success.success",
                UsersResource::collection($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        try{
            $dto = new CreateUserDTO($request->validated());
            $data = $this->UserService->createUser($dto);

            return response()->success(
                "user.success.created",
                new UserResource($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $data = $this->UserService->findUserById($id);

            return response()->success(
                "user.success.showed",
                 new UserResource($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        try{
            $dto = new UpdateUserDTO($request->validated());
            $data = $this->UserService->updateUser($id, $dto);

            return response()->success(
                "user.success.updated",
                new UserResource($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $this->UserService->deleteUser($id);

            return response()->success(
                "user.success.deleted"
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }
}
