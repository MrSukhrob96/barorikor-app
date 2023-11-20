<?php

namespace App\Repositories;

use App\Core\CoreRepository;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Models\City;

class CityRepository extends CoreRepository implements CityRepositoryInterface
{

    public function __construct(City $model)
    {
        parent::__construct($model);
    }

    /**
     * Method findByName
     * 
     * @param string $name
     * @return ?City
     */
    public function findByName(string $name): ?City
    {
        return $this->model->query()
            ->where("name", $name)
            ->first();
    }
    
}
