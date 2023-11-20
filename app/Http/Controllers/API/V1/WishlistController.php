<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;

use App\Services\Interfaces\WishlistServiceInterface;
use App\Http\Requests\Wishlist\CreateWishlistRequest;
use App\Http\Requests\Wishlist\UpdateWishlistRequest;
use App\Http\Resources\Wishlist\WishlistResource;
use App\Http\Resources\Wishlist\WishlistsResource;
use App\DTO\Wishlist\CreateWishlistDTO;
use App\DTO\Wishlist\UpdateWishlistDTO;

class WishlistController extends Controller
{
    public function __construct(
        private readonly WishlistServiceInterface $wishlistService,
    ){
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $data = $this->wishlistService->getAllWishlist();

            return response()->success(
                "wishlist.success.success",
                WishlistsResource::collection($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateWishlistRequest $request)
    {
        try{
            $dto = new CreateWishlistDTO($request->validated());
            $data = $this->wishlistService->createWishlist($dto);

            return response()->success(
                "wishlist.success.created",
                new WishlistResource($data),
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
            $data = $this->wishlistService->findWishlistById($id);

            return response()->success(
                "wishlist.success.showed",
                 new WishlistResource($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWishlistRequest $request, string $id)
    {
        try{
            $dto = new UpdateWishlistDTO($request->validated());
            $data = $this->wishlistService->updateWishlist($id, $dto);

            return response()->success(
                "wishlist.success.updated",
                new WishlistResource($data),
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
            $this->wishlistService->deleteWishlist($id);

            return response()->success(
                "wishlist.success.deleted"
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }
}
