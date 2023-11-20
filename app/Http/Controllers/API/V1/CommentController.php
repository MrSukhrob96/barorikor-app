<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;

use App\Services\Interfaces\CommentServiceInterface;
use App\Http\Requests\Comment\CreateCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Comment\CommentsResource;
use App\DTO\Comment\CreateCommentDTO;
use App\DTO\Comment\UpdateCommentDTO;

class CommentController extends Controller
{
    public function __construct(
        protected readonly CommentServiceInterface $CommentService,
    ){
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $data = $this->CommentService->getAllComments();

            return response()->success(
                "comment.success.success",
                CommentsResource::collection($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCommentRequest $request)
    {
        try{
            $dto = new CreateCommentDTO($request->validated());
            $data = $this->CommentService->createComment($dto);

            return response()->success(
                "comment.success.created",
                new CommentResource($data),
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
            $data = $this->CommentService->findCommentById($id);

            return response()->success(
                "comment.success.showed",
                 new CommentResource($data),
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, string $id)
    {
        try{
            $dto = new UpdateCommentDTO($request->validated());
            $data = $this->CommentService->updateComment($id, $dto);

            return response()->success(
                "comment.success.updated",
                new CommentResource($data),
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
            $this->CommentService->deleteComment($id);

            return response()->success(
                "comment.success.deleted"
            );
        }catch(\Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }
}
