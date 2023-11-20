<?php

namespace App\Repositories;

use App\Core\CoreRepository;
use App\Repositories\Interfaces\PortfolioRepositoryInterface;
use App\Models\Portfolio;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PortfolioRepository extends CoreRepository implements PortfolioRepositoryInterface
{

    public function __construct(Portfolio $model)
    {
        parent::__construct($model);
    }

    /**
     * Method getPaginatedSortedPortfolio
     * 
     * @param int $limit
     * @param int $offset
     * @param array $columns
     * @param array $relations
     * @return ?LengthAwarePaginator
     */
    public function getPaginatedSortedPortfolio(
        int $limit,
        int $offset,
        array $columns = ['*'],
        array $relations = [],
    ): ?LengthAwarePaginator {
        $query = $this->model->query()->select($columns)->with($relations);

        $posts = app(Pipeline::class)
            ->send($query)
            ->through([
                \App\QueryFilters\Post\SortQueryFilter::class,
                \App\QueryFilters\Post\SelectColumnsQueryFilter::class
            ])
            ->thenReturn();

        return $posts->paginate($limit, ['*'], 'page', $offset);
    }
}
