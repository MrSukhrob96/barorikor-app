<?php

namespace App\Repositories;

use App\Core\CoreRepository;
use App\Repositories\Interfaces\RatingRepositoryInterface;
use App\Models\Rating;

class RatingRepository extends CoreRepository implements RatingRepositoryInterface {

    public function __construct(Rating $model)
    {
        parent::__construct($model);
    }
}