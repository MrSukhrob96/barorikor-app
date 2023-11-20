<?php

namespace App\Repositories;

use App\Core\CoreRepository;
use App\Repositories\Interfaces\ImagesRepositoryInterface;
use App\Models\Images;

class ImagesRepository extends CoreRepository implements ImagesRepositoryInterface {

    public function __construct(Images $model)
    {
        parent::__construct($model);
    }
}