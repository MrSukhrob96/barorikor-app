<?php

namespace App\Repositories\Interfaces;

use App\Core\Interfaces\CoreRepositoryInterface;
use App\Models\Category;

interface CategoryRepositoryInterface extends CoreRepositoryInterface
{
    public function findByName(string $name): ?Category;
}
