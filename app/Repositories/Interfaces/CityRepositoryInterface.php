<?php

namespace App\Repositories\Interfaces;

use App\Core\Interfaces\CoreRepositoryInterface;
use App\Models\City;

interface CityRepositoryInterface extends CoreRepositoryInterface
{
    public function findByName(string $name): ?City;
}
