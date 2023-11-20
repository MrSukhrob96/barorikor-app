<?php

namespace App\Repositories\Interfaces;

use App\Core\Interfaces\CoreRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface WishlistRepositoryInterface extends CoreRepositoryInterface
{
    public function getAllByUser(int $id): ?Collection;
}
