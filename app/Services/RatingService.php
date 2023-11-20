<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Rating;
use App\DTO\Rating\CreateRatingDTO;
use App\DTO\Rating\UpdateRatingDTO;
use App\Repositories\Interfaces\RatingRepositoryInterface;
use App\Services\Interfaces\RatingServiceInterface;

class RatingService implements RatingServiceInterface
{

    public function __construct(
        private readonly RatingRepositoryInterface $ratingRepository,
    ) {
    }

    /**
     * Method getAllRating
     *
     * @returns Collection
     */
    public function getAllRating(): ?Collection
    {
        throw new \Exception();
    }

    /**
     * Method findRatingById
     *
     * @param int|string $id
     * @returns ?Rating
     */
    public function findRatingById(int|string $id): ?Rating
    {
        return $this->ratingRepository->findById($id);
    }

    /**
     * Method createRating
     *
     * @param CreateRatingDTO $dto
     * @returns ?Rating 
     */
    public function createRating(CreateRatingDTO $dto): ?Rating
    {
        return $this->ratingRepository->create($dto->toArray());
    }

    /**
     * Method updateRating
     *
     * @param int|string $id
     * @param UpdateRatingDTO $dto
     * @returns ?Rating 
     */
    public function updateRating(int|string $id, UpdateRatingDTO $dto): ?Rating
    {
        return $this->ratingRepository->updateOrCreate(
            data: $dto->toArray(),
            where: ["id" => $id]
        );
    }

    /**
     * Method deleteRating
     *
     * @param int|string $id
     * @returns void
     * @throws \Exception
     */
    public function deleteRating(int|string $id): void
    {
        $this->ratingRepository->delete($id);
    }
}
