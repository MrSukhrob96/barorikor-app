<?php

namespace App\Services\Interfaces;

use App\DTO\Category\CreateCategoryDTO;
use App\DTO\Category\UpdateCategoryDTO;

interface CategoryServiceInterface {

    public function getAllCategories();

    public function findCategoryById(string|int $id);

    public function createCategory(CreateCategoryDTO $dto);

    public function updateCategory(int|string $id, UpdateCategoryDTO $dto);

    public function deleteCategory(int|string $id);

}