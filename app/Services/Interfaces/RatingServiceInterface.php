<?php

namespace App\Services\Interfaces;

use App\DTO\Rating\CreateRatingDTO;
use App\DTO\Rating\UpdateRatingDTO;

interface RatingServiceInterface {

    public function getAllRating();

    public function findRatingById(string|int $id);

    public function createRating(CreateRatingDTO $dto);

    public function updateRating(int|string $id, UpdateRatingDTO $dto);

    public function deleteRating(int|string $id);

}