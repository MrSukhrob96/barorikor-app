<?php

namespace App\Services\Interfaces;

use App\DTO\Wishlist\CreateWishlistDTO;
use App\DTO\Wishlist\UpdateWishlistDTO;

interface WishlistServiceInterface {

    public function getAllWishlist();

    public function findWishlistById(string|int $id);

    public function createWishlist(CreateWishlistDTO $dto);

    public function updateWishlist(int|string $id, UpdateWishlistDTO $dto);

    public function deleteWishlist(int|string $id);

}