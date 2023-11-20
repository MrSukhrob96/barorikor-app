<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;

use App\Services\Interfaces\PortfolioServiceInterface;
use App\Http\Requests\Portfolio\CreatePortfolioRequest;
use App\Http\Requests\Portfolio\UpdatePortfolioRequest;
use App\Http\Resources\Portfolio\PortfolioResource;
use App\Http\Resources\Portfolio\PortfoliosResource;
use App\DTO\Portfolio\CreatePortfolioDTO;
use App\DTO\Portfolio\UpdatePortfolioDTO;

class PortfolioController extends Controller
{
    public function __construct(
        protected readonly PortfolioServiceInterface $PortfolioService,
    ){
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $data = $this->PortfolioService->getAllPortfolio();

            return response()->success(
                "portfolio.success.success",
                PortfoliosResource::collection($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePortfolioRequest $request)
    {
        try{
            $dto = new CreatePortfolioDTO($request->validated());
            $data = $this->PortfolioService->createPortfolio($dto);

            return response()->success(
                "portfolio.success.created",
                new PortfolioResource($data),
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
            $data = $this->PortfolioService->findPortfolioById($id);

            return response()->success(
                "portfolio.success.showed",
                 new PortfolioResource($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePortfolioRequest $request, string $id)
    {
        try{
            $dto = new UpdatePortfolioDTO($request->validated());
            $data = $this->PortfolioService->updatePortfolio($id, $dto);

            return response()->success(
                "portfolio.success.updated",
                new PortfolioResource($data),
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
            $this->PortfolioService->deletePortfolio($id);

            return response()->success(
                "portfolio.success.deleted"
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }
}
