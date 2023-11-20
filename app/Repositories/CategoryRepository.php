<?php

namespace App\Repositories;

use App\Core\CoreRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository extends CoreRepository implements CategoryRepositoryInterface
{

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * Method findByName
     * 
     * @param string $name
     * @return ?Category
     */
    public function findByName(string $name): ?Category
    {
        return $this->model->query()
            ->where("name", $name)
            ->first();
    }
}
