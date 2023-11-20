<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Models\City;
use App\DTO\City\CreateCityDTO;
use App\DTO\City\UpdateCityDTO;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Services\Interfaces\CityServiceInterface;
use Illuminate\Contracts\Cache\Repository as CacheRepositoryInterface;

class CityService implements CityServiceInterface
{

    public function __construct(
        private readonly CityRepositoryInterface $cityRepository,
        private readonly CacheRepositoryInterface $cacheRepository
    ) {
    }

    /**
     * Method getAllCities
     *
     * @return ?Collection
     */
    public function getAllCities(): ?Collection
    {
        return $this->cacheRepository->rememberForever(
            "cities",
            function () {
                return $this->cityRepository->getAll(
                    columns: ["id", "name"]
                );
            }
        );
    }

    /**
     * Method findCityById
     *
     * @param int|string $id
     * @return ?City
     */
    public function findCityById(int|string $id): ?City
    {
        return $this->cityRepository->findById($id);
    }

    /**
     * Method createCity
     *
     * @param CreateCityDTO $dto
     * @return ?City 
     */
    public function createCity(CreateCityDTO $dto): ?City
    {
        $city = $this->cityRepository->findByName($dto->name);

        if ($city) {
            throw new \Exception("city.error.exists");
        }

        return $this->cityRepository->create($dto->toArray());
    }

    /**
     * Method updateCity
     *
     * @param int|string $id
     * @param UpdateCityDTO $dto
     * @return ?City 
     */
    public function updateCity(int|string $id, UpdateCityDTO $dto): ?City
    {
        $city = $this->cityRepository->findById($id);

        if (!$city) {
            throw new \Exception("city.error.notExists");
        }

        return $this->cityRepository->updateOrCreate(
            $dto->toArray(),
            ["id" => $id, "name" => $dto->name]
        );
    }

    /**
     * Method deleteCity
     *
     * @param int|string $id
     * @return void
     * @throws \Exception
     */
    public function deleteCity(int|string $id): void
    {
        $city = $this->cityRepository->findById($id);

        if (!$city) {
            throw new \Exception("city.error.notExists");
        }

        $this->cityRepository->delete($id);
    }
}
