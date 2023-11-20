<?php

namespace App\Services\Interfaces;

use App\DTO\Comment\CreateCommentDTO;
use App\DTO\Comment\UpdateCommentDTO;
use Illuminate\Database\Eloquent\Collection;

interface CommentServiceInterface {

    public function getAllComments(): ?Collection;

    public function findCommentById(string|int $id);

    public function createComment(CreateCommentDTO $dto);

    public function updateComment(int|string $id, UpdateCommentDTO $dto);

    public function deleteComment(int|string $id);

}