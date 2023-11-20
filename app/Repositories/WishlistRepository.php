<?php

namespace App\Repositories;

use App\Core\CoreRepository;
use App\Repositories\Interfaces\WishlistRepositoryInterface;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Collection;

class WishlistRepository extends CoreRepository implements WishlistRepositoryInterface
{

    public function __construct(Wishlist $model)
    {
        parent::__construct($model);
    }

    /**
     * Method getAllByUser
     * 
     * @param int $id
     * @return ?Colection
     */
    public function getAllByUser(int $id): ?Collection
    {
        return $this->model->query()
            ->where("user_id", $id)
            ->get();
    }
}
