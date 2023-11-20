<?php

namespace App\Repositories;

use App\Core\CoreRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends CoreRepository implements UserRepositoryInterface
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Method findByPhoneNumber
     * 
     * @param string $phoneNumber
     * @return ?User
     */
    public function findByPhoneNumber(string $phoneNumber): ?User
    {
        return $this->model->query()
            ->where("phoneNumber", $phoneNumber)
            ->first();
    }

    /**
     * Method existsPhoneNumber
     * 
     * @param int $id user id
     * @param string $phoneNumber
     * @return bool
     */
    public function existsPhoneNumber(int $id, string $phoneNumber): bool
    {
        return $this->model->query()
            ->whereNot("id", $id)
            ->where("phoneNumber", $phoneNumber)
            ->exists();
    }
}
