<?php

namespace App\Http\Service;

use App\Http\Repository\CommentRepository;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CommentResource;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Response;

class CommentService
{
    use RespondsWithHttpStatus;

    public function index()
    {
        $category = CommentRepository::index();
        return $this->success(new CategoryCollection($category), Response::HTTP_OK);
    }

    /**
     * @OA\Schema(
     *      schema="Comment",
     *      title="Comment",
     *      description="Comment create request body",
     *      type="object",
     *      required={"project_id", "comment"},
     *      @OA\Property(
     *          property="project_id",
     *          description="Id of a project",
     *          example="1",
     *          type="integer"
     *      ),
     *      @OA\Property(
     *          property="comment",
     *          description="Comment of a project",
     *          example="Art",
     *          type="string"
     *      )
     * )
     */
    public function create($request)
    {
        $comment = CommentRepository::store($request);

        if ($comment) {
            return $this->success(trans('messages.create'), Response::HTTP_CREATED);
        }

    }

    /**
     * @OA\Schema(
     *      schema="UpdateComment",
     *      title="Update Comment",
     *      description="Comment update request body",
     *      type="object",
     *      required={"id", "project_id", "comment"},
     *     @OA\Property(
     *          property="id",
     *          description="ID of Comment",
     *          example="2",
     *          type="integer"
     *      ),
     *      @OA\Property(
     *          property="project_id",
     *          description="Id of a project",
     *          example="1",
     *          type="integer"
     *      ),
     *      @OA\Property(
     *          property="comment",
     *          description="Cooment of a project",
     *          example="This porject is good.",
     *          type="string"
     *      )
     * )
     */
    public function update($request)
    {
        $comment = CommentRepository::findById($request->id);

        if (!$comment) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        if ($comment) {
            $isUpdate = CommentRepository::update($request, $comment);

            if ($isUpdate) {
                return $this->success(trans('messages.update'), Response::HTTP_OK);
            }

        }

    }

    public function show($id)
    {
        $comment = CommentRepository::findById($id);

        if (!$comment) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(new CommentResource($comment), Response::HTTP_OK);
    }

    public function delete($id)
    {
        $comment = CommentRepository::findById($id);

        if (!$comment) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(CommentRepository::delete($comment));
    }

}