<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Http\Service\CommentService;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public $commentService;

    public function __construct( CommentService $commentService )
    {
        $this->commentService = $commentService;
    }

    /**
     * @OA\Post(
     *      path="/api/v1/comment/create",
     *      tags={"Comment"},
     *      summary="Create comment",
     *      description="Add new comment",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Comment")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Comment",
     *          @OA\JsonContent(ref="#/components/schemas/Comment")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *   security={{"Token": {}}}
     * )
     */
    public function create( CommentCreateRequest $request )
    {
        $request['created_by'] = Auth::id();

        return $this->commentService->create( $request );
    }

    /**
     * @OA\Put(
     *      path="/api/v1/comment/update",
     *      tags={"Comment"},
     *      summary="Update comment",
     *      description="Update comment",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateComment")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UpdateComment")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      security={{"Token": {}}}
     * )
     */
    public function update( CommentUpdateRequest $request )
    {
        $request['updated_by'] = Auth::id();

        return $this->commentService->update( $request );
    }

    /**
     * @OA\Get(
     *      path="/api/v1/comment/show/{id}",
     *      tags={"Comment"},
     *      summary="Show Comment",
     *      description="Show Comment Info by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Comment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      security={{"Token": {}}}
     * )
     */
    public function show( $id )
    {
        return $this->commentService->show( $id );
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/comment/delete/{id}",
     *      tags={"Comment"},
     *      summary="Delete Comment by Id",
     *      description="Delete Comment by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Comment Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      security={{"Token": {}}}
     * )
     */
    public function delete( $id )
    {
        return $this->commentService->delete( $id );
    }

}