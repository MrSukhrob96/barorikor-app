<?php

namespace App\Repositories\Interfaces;

use App\Core\Interfaces\CoreRepositoryInterface;
use App\Models\User;

interface UserRepositoryInterface extends CoreRepositoryInterface
{
    public function findByPhoneNumber(string $phoneNumber): ?User;

    public function existsPhoneNumber(int $id, string $phoneNumber): bool;
}
