<?php

namespace App\Services;

use App\Core\CoreService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Wishlist;
use App\DTO\Wishlist\CreateWishlistDTO;
use App\DTO\Wishlist\UpdateWishlistDTO;
use App\Repositories\Interfaces\WishlistRepositoryInterface;
use App\Services\Interfaces\WishlistServiceInterface;

class WishlistService extends CoreService implements WishlistServiceInterface
{

    public function __construct(
        private readonly WishlistRepositoryInterface $wishlistRepository,
    ) {
    }

    /**
     * Method getAllWishlist
     *
     * @returns Collection
     */
    public function getAllWishlist(): ?Collection
    {
        if (!$this->isAdmin()) {
            $userId = $this->getAuthUserId();
            return $this->wishlistRepository->getAllByUser($userId);
        }

        return $this->wishlistRepository->getAll();
    }

    /**
     * Method findWishlistById
     *
     * @param int|string $id
     * @returns ?Wishlist
     */
    public function findWishlistById(int|string $id): ?Wishlist
    {
        return $this->wishlistRepository->findById($id);
    }

    /**
     * Method createWishlist
     *
     * @param CreateWishlistDTO $dto
     * @returns ?Wishlist 
     */
    public function createWishlist(CreateWishlistDTO $dto): ?Wishlist
    {
        return $this->wishlistRepository->firstOrCreate(
            data: $dto->toArray(),
            where: $dto->toArray()
        );
    }

    /**
     * Method updateWishlist
     *
     * @param int|string $id
     * @param UpdateWishlistDTO $dto
     * @returns ?Wishlist 
     */
    public function updateWishlist(int|string $id, UpdateWishlistDTO $dto): ?Wishlist
    {
        throw new \Exception();
    }

    /**
     * Method deleteWishlist
     *
     * @param int|string $id
     * @returns void
     * @throws \Exception
     */
    public function deleteWishlist(int|string $id): void
    {
        $this->wishlistRepository->delete($id);
    }
}
