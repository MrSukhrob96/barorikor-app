<?php

namespace App\Services\Interfaces;

use App\DTO\Portfolio\CreatePortfolioDTO;
use App\DTO\Portfolio\UpdatePortfolioDTO;

interface PortfolioServiceInterface {

    public function getAllPortfolio();

    public function findPortfolioById(string|int $id);

    public function createPortfolio(CreatePortfolioDTO $dto);

    public function updatePortfolio(int|string $id, UpdatePortfolioDTO $dto);

    public function deletePortfolio(int|string $id);

}