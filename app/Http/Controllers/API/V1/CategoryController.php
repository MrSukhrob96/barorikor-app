<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;

use App\Services\Interfaces\CategoryServiceInterface;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoriesResource;
use App\DTO\Category\CreateCategoryDTO;
use App\DTO\Category\UpdateCategoryDTO;

class CategoryController extends Controller
{
    public function __construct(
        protected readonly CategoryServiceInterface $categoryService,
    ){
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $data = $this->categoryService->getAllCategories();

            return response()->success(
                "category.success.success",
                CategoriesResource::collection($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        try{
            $dto = new CreateCategoryDTO($request->validated());
            $data = $this->categoryService->createCategory($dto);

            return response()->success(
                "category.success.created",
                new CategoryResource($data),
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
            $data = $this->categoryService->findCategoryById($id);

            return response()->success(
                "category.success.showed",
                 new CategoryResource($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        try{
            $dto = new UpdateCategoryDTO($request->validated());
            $data = $this->categoryService->updateCategory($id, $dto);

            return response()->success(
                "category.success.updated",
                new CategoryResource($data),
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
            $this->categoryService->deleteCategory($id);

            return response()->success(
                "category.success.deleted"
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }
}
