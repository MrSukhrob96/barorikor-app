<?php

namespace App\Services;

use App\Core\CoreService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use App\DTO\User\CreateUserDTO;
use App\DTO\User\UpdateUserDTO;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Contracts\Cache\Repository as CacheRepositoryInterface;

class UserService extends CoreService implements UserServiceInterface
{

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly CacheRepositoryInterface $cacheRepository
    ) {
    }

    /**
     * 
     */
    public function getUsersWithPagination($limit, $offset): ?LengthAwarePaginator
    {
        $cacheKey = "users" . $offset . $limit;

        return $this->cacheRepository->rememberForever(
            $cacheKey,
            function () use ($limit, $offset) {
                return $this->userRepository->getWithPagination(
                    limit: $limit,
                    offset: $offset
                );
            }
        );
    }

    /**
     * Method getAllUser
     *
     * @returns Collection
     */
    public function getAllUsers(): ?Collection
    {
        return $this->userRepository->getAll(
            columns: ["id", "firstName", "lastName", "phoneNumber", "email", "role"]
        );
    }

    /**
     * Method findUserById
     *
     * @param int|string $id
     * @returns ?User
     */
    public function findUserById(int|string $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    /**
     * Method createUser
     *
     * @param CreateUserDTO $dto
     * @returns ?User 
     */
    public function createUser(CreateUserDTO $dto): ?User
    {
        $phoneNumber = $this->getPhoneNumber($dto->phoneNumber);

        if ($this->userRepository->findByPhoneNumber($phoneNumber)) {
            throw new \Exception("user.error.exists");
        }

        return $this->userRepository->create($dto->toArray());
    }

    /**
     * Method updateUser
     *
     * @param int|string $id
     * @param UpdateUserDTO $dto
     * @returns ?User 
     */
    public function updateUser(int|string $id, UpdateUserDTO $dto): ?User
    {
        $phoneNumber = $this->getPhoneNumber($dto->phoneNumber);
        $isExists = $this->userRepository->existsPhoneNumber($id, $phoneNumber);

        if ($isExists) {
            throw new \Exception("user.error.exists");
        }

        $this->userRepository->update($id, $dto->toArray());
        throw new \Exception();
    }

    /**
     * Method deleteUser
     *
     * @param int|string $id
     * @returns void
     * @throws \Exception
     */
    public function deleteUser(int|string $id): void
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new \Exception("user.error.notExists");
        }

        $this->userRepository->delete($id);
    }
}
