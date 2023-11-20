<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;
use App\DTO\Category\CreateCategoryDTO;
use App\DTO\Category\UpdateCategoryDTO;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use Illuminate\Contracts\Cache\Repository as CacheRepositoryInterface;

class CategoryService implements CategoryServiceInterface
{

    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly CacheRepositoryInterface $cacheRepository
    ) {
    }


    /**
     * Method getAllCategories
     *
     * @return Collection
     */
    public function getAllCategories(): ?Collection
    {
        return $this->cacheRepository->rememberForever(
            "categories",
            function () {
                return $this->categoryRepository->getAll(
                    columns: ["id", "name", "icon"]
                );
            }
        );
    }

    /**
     * Method findCategoryById
     *
     * @param int|string $id
     * @return ?Category
     */
    public function findCategoryById(int|string $id): ?Category
    {
        return $this->categoryRepository->findById($id);
    }

    /**
     * Method createCategory
     *
     * @param CreateCategoryDTO $dto
     * @return ?Category 
     */
    public function createCategory(CreateCategoryDTO $dto): ?Category
    {
        $category = $this->categoryRepository->findByName($dto->name);

        if (!$category) {
            throw new \Exception("category.error.exists");
        }

        return $category;
    }

    /**
     * Method updateCategory
     *
     * @param int|string $id
     * @param UpdateCategoryDTO $dto
     * @return ?Category 
     */
    public function updateCategory(int|string $id, UpdateCategoryDTO $dto): ?Category
    {
        $category = $this->categoryRepository->findByName($dto->name);

        if (!$category) {
            throw new \Exception("category.error.exists");
        }

        $this->categoryRepository->update($id, $dto->toArray());

        throw new \Exception;
    }

    /**
     * Method deleteCategory
     *
     * @param int|string $id
     * @return void
     * @throws \Exception
     */
    public function deleteCategory(int|string $id): void
    {
        $category = $this->categoryRepository->findById($id);

        if (!$category) {
            throw new \Exception("category.error.notExists");
        }

        $this->categoryRepository->delete($id);
    }
}
