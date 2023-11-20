<?php

namespace App\Repositories;

use App\Core\CoreRepository;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository extends CoreRepository implements CommentRepositoryInterface
{

    const DEFAULT_COMMENTS_LENGTH = 5;

    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    /**
     * Method getByPortfolio
     * 
     * @param int $id
     * @return ?Colection
     */
    public function getByPortfolio(int $id): ?Collection
    {
        return $this->model->query()
            ->with("portfolio_id", $id)
            ->get();
    }

    /**
     * Method getCommentsByUser
     * 
     * @param int $id
     * @return ?Collection
     */
    public function getCommentsByUser(int $id): ?Collection
    {
        return $this->model->query()
            ->where("user_id", $id)
            ->latest()
            ->take(self::DEFAULT_COMMENTS_LENGTH)
            ->get();
    }

    /**
     * Method getAllCommentsByUser
     * 
     * @param int $id
     * @param int $limit
     * @param int $offset
     * @return LengthAwarePaginator
     */
    public function getAllCommentsByUser(int $id, int $limit, int $offset): LengthAwarePaginator
    {
        return $this->model->query()
            ->with("user")
            ->where("user_id", $id)
            ->paginate($limit, ['*'], 'page', $offset);
    }
}
