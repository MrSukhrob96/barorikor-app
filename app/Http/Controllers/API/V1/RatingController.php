<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;

use App\Services\Interfaces\RatingServiceInterface;
use App\Http\Requests\Rating\CreateRatingRequest;
use App\Http\Requests\Rating\UpdateRatingRequest;
use App\Http\Resources\Rating\RatingResource;
use App\Http\Resources\Rating\RatingsResource;
use App\DTO\Rating\CreateRatingDTO;
use App\DTO\Rating\UpdateRatingDTO;

class RatingController extends Controller
{
    public function __construct(
        protected readonly RatingServiceInterface $RatingService,
    ){
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $data = $this->RatingService->getAllRating();

            return response()->success(
                "rating.success.success",
                RatingsResource::collection($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRatingRequest $request)
    {
        try{
            $dto = new CreateRatingDTO($request->validated());
            $data = $this->RatingService->createRating($dto);

            return response()->success(
                "rating.success.created",
                new RatingResource($data),
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
            $data = $this->RatingService->findRatingById($id);

            return response()->success(
                "rating.success.showed",
                 new RatingResource($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRatingRequest $request, string $id)
    {
        try{
            $dto = new UpdateRatingDTO($request->validated());
            $data = $this->RatingService->updateRating($id, $dto);

            return response()->success(
                "rating.success.updated",
                new RatingResource($data),
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
            $this->RatingService->deleteRating($id);

            return response()->success(
                "rating.success.deleted"
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }
}
