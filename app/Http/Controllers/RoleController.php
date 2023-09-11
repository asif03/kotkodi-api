<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Service\RoleService;

class RoleController extends Controller
{
    public $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/role/list",
     *      tags={"Role"},
     *      summary="Get list of role",
     *      description="Returns list of role",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      security={{"Token": {}}}
     *     )
     */
    public function index()
    {
        return $this->roleService->index();
    }

    /**
     * @OA\Post(
     *      path="/api/v1/role/create",
     *      tags={"Role"},
     *      summary="Create role",
     *      description="Create a new role with permission",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Role")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Role",
     *          @OA\JsonContent(ref="#/components/schemas/Role")
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
    public function create(RoleCreateRequest $request)
    {
        return $this->roleService->create($request);
    }

    public function update(RoleUpdateRequest $request)
    {
        return $this->roleService->update($request);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/role/show/{id}",
     *      tags={"Role"},
     *      summary="Show role info",
     *      description="Show role by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Role Id",
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
    public function show($id)
    {
        return $this->roleService->show($id);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/role/delete/{id}",
     *      tags={"Role"},
     *      summary="Delete role by Id",
     *      description="Delete role by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Role Id",
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
    public function delete($id)
    {
        return $this->roleService->delete($id);
    }
}