<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;

use App\Services\Interfaces\CityServiceInterface;
use App\Http\Requests\City\CreateCityRequest;
use App\Http\Requests\City\UpdateCityRequest;
use App\Http\Resources\City\CityResource;
use App\Http\Resources\City\CitiesResource;
use App\DTO\City\CreateCityDTO;
use App\DTO\City\UpdateCityDTO;

class CityController extends Controller
{
    public function __construct(
        protected readonly CityServiceInterface $CityService,
    ){
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $data = $this->CityService->getAllCities();

            return response()->success(
                "city.success.success",
                CitiesResource::collection($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCityRequest $request)
    {
        try{
            $dto = new CreateCityDTO($request->validated());
            $data = $this->CityService->createCity($dto);

            return response()->success(
                "city.success.created",
                new CityResource($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $data = $this->CityService->findCityById($id);

            return response()->success(
                "city.success.showed",
                 new CityResource($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, string $id)
    {
        try{
            $dto = new UpdateCityDTO($request->validated());
            $data = $this->CityService->updateCity($id, $dto);

            return response()->success(
                "city.success.updated",
                new CityResource($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $this->CityService->deleteCity($id);

            return response()->success(
                "city.success.deleted"
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }
}
