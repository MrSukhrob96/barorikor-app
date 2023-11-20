<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Portfolio;
use App\DTO\Portfolio\CreatePortfolioDTO;
use App\DTO\Portfolio\UpdatePortfolioDTO;
use App\Repositories\Interfaces\PortfolioRepositoryInterface;
use App\Services\Interfaces\PortfolioServiceInterface;

class PortfolioService implements PortfolioServiceInterface
{

    public function __construct(
        private readonly PortfolioRepositoryInterface $portfolioRepository,
    ) {
    }

    /**
     * Method getWithPagination
     * 
     * @param int $limit
     * @param int $offset
     * @return LengthAwarePaginator
     */
    public function getWithPagination(int $limit, int $offset): ?LengthAwarePaginator
    {
        throw new \Exception();
    }

    /**
     * Method getAllPortfolio
     *
     * @returns Collection
     */
    public function getAllPortfolio(): ?Collection
    {
        throw new \Exception();
    }

    /**
     * Method findPortfolioById
     *
     * @param int|string $id
     * @returns ?Portfolio
     */
    public function findPortfolioById(int|string $id): ?Portfolio
    {
        return $this->portfolioRepository->findById($id);
    }

    /**
     * Method createPortfolio
     *
     * @param CreatePortfolioDTO $dto
     * @returns ?Portfolio 
     */
    public function createPortfolio(CreatePortfolioDTO $dto): ?Portfolio
    {
        return $this->portfolioRepository->create($dto->toArray());
    }

    /**
     * Method updatePortfolio
     *
     * @param int|string $id
     * @param UpdatePortfolioDTO $dto
     * @returns ?Portfolio 
     */
    public function updatePortfolio(int|string $id, UpdatePortfolioDTO $dto): ?Portfolio
    {
        return $this->portfolioRepository->updateOrCreate(
            data: $dto->toArray(),
            where: ["id" => $id]
        );
    }

    /**
     * Method deletePortfolio
     *
     * @param int|string $id
     * @returns void
     * @throws \Exception
     */
    public function deletePortfolio(int|string $id): void
    {
        $this->portfolioRepository->delete($id);
    }
}
