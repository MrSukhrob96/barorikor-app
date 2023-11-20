<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Comment;
use App\DTO\Comment\CreateCommentDTO;
use App\DTO\Comment\UpdateCommentDTO;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Services\Interfaces\CommentServiceInterface;
use Illuminate\Contracts\Cache\Repository as CacheRepositoryInterface;

class CommentService implements CommentServiceInterface
{

    public function __construct(
        private readonly CommentRepositoryInterface $commentRepository,
        private readonly CacheRepositoryInterface $cacheRepository,
    ) {
    }

    /**
     * Method getAllComment
     *
     * @returns Collection
     */
    public function getAllComments(): ?Collection
    {
        return $this->cacheRepository->rememberForever(
            "cities",
            function () {
                return $this->commentRepository->getAll(
                    columns: ["id", "name"]
                );
            }
        );
    }

    /**
     * Method findCommentById
     *
     * @param int|string $id
     * @returns ?Comment
     */
    public function findCommentById(int|string $id): ?Comment
    {
        return $this->commentRepository->findById($id);
    }

    /**
     * Method createComment
     *
     * @param CreateCommentDTO $dto
     * @returns ?Comment 
     */
    public function createComment(CreateCommentDTO $dto): ?Comment
    {
        return $this->commentRepository->create($dto->toArray());
    }

    /**
     * Method updateComment
     *
     * @param int|string $id
     * @param UpdateCommentDTO $dto
     * @returns ?Comment 
     */
    public function updateComment(int|string $id, UpdateCommentDTO $dto): ?Comment
    {
        $comment = $this->commentRepository->findById($id);

        if (!$comment) {
            throw new \Exception("comment.error.notExists");
        }

        return $this->commentRepository->updateOrCreate(
            data: $dto->toArray(),
            where: ["id" => $id],
        );
    }

    /**
     * Method deleteComment
     *
     * @param int|string $id
     * @returns void
     * @throws \Exception
     */
    public function deleteComment(int|string $id): void
    {
        $comment = $this->commentRepository->findById($id);

        if (!$comment) 
        {
            throw new \Exception("comment.error.notExists");
        }

        $this->commentRepository->delete($id);
    }
}
