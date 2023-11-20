<?php

namespace App\Repositories\Interfaces;

use App\Core\Interfaces\CoreRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PortfolioRepositoryInterface extends CoreRepositoryInterface
{
    public function getPaginatedSortedPortfolio(
        int $limit,
        int $offset,
        array $columns = ['*'],
        array $relations = [],
    ): ?LengthAwarePaginator;
}
