<?php

namespace App\Services\Interfaces;

use App\DTO\City\CreateCityDTO;
use App\DTO\City\UpdateCityDTO;

interface CityServiceInterface {

    public function getAllCities();

    public function findCityById(string|int $id);

    public function createCity(CreateCityDTO $dto);

    public function updateCity(int|string $id, UpdateCityDTO $dto);

    public function deleteCity(int|string $id);

}