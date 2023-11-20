<?php

namespace App\Services\Interfaces;

use App\DTO\User\CreateUserDTO;
use App\DTO\User\UpdateUserDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface {

    public function getUsersWithPagination($limit, $offset): ?LengthAwarePaginator;

    public function getAllUsers(): ?Collection;

    public function findUserById(string|int $id);

    public function createUser(CreateUserDTO $dto);

    public function updateUser(int|string $id, UpdateUserDTO $dto);

    public function deleteUser(int|string $id);

}