<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Service\CategoryService;

class CategoryController extends Controller
{
    public $categoryService;

    public function __construct( CategoryService $categoryService )
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/category/list",
     *      tags={"Category"},
     *      summary="Get list of category",
     *      description="Returns list of category",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function index()
    {
        return $this->categoryService->index();
    }

    /**
     * @OA\Post(
     *      path="/api/v1/category/create",
     *      tags={"Category"},
     *      summary="Create category",
     *      description="Add new category",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Category")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Category",
     *          @OA\JsonContent(ref="#/components/schemas/Category")
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
    public function create( CategoryCreateRequest $request )
    {
        return $this->categoryService->create( $request );
    }
    /**
     * @OA\Put(
     *      path="/api/v1/category/update",
     *      tags={"Category"},
     *      summary="Update category",
     *      description="Update category",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCategory")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCategory")
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
     *   security={{"Token": {}}}
     * )
     */
    public function update( CategoryUpdateRequest $request )
    {
        return $this->categoryService->update( $request );
    }

    /**
     * @OA\Get(
     *      path="/api/v1/category/show/{id}",
     *      tags={"Category"},
     *      summary="Show Category Info",
     *      description="Show Category Info by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
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
        return $this->categoryService->show( $id );
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/category/delete/{id}",
     *      tags={"Category"},
     *      summary="Delete Category by Id",
     *      description="Delete Category by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Category Id",
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
        return $this->categoryService->delete( $id );
    }
}