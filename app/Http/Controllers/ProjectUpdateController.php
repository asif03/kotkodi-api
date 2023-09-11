<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectUpdateCreateRequest;
use App\Http\Requests\ProjectUpdateUpdateRequest;
use App\Http\Service\ProjectUpdateService;
use Illuminate\Http\Request;

class ProjectUpdateController extends Controller
{
    public $projectUpdateService;

    public function __construct(ProjectUpdateService $projectUpdateService)
    {
        $this->projectUpdateService = $projectUpdateService;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/project-update/list",
     *      tags={"Project Update"},
     *      summary="Get list of project updates of Projects",
     *      description="Returns list of project updates",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      security={{"Token": {}}}
     *     )
     */
    public function index(Request $request)
    {
        return $this->projectUpdateService->index($request);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/project-update/project/{id}",
     *      tags={"Project Update"},
     *      summary="Project wise update list",
     *      description="Returns list of updates for a particular project",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project ID",
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
    public function listByProject($id)
    {
        return $this->projectUpdateService->listByProject($id);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/project-update/show/{id}",
     *      tags={"Project Update"},
     *      summary="Show project update info",
     *      description="Show Project Update Info by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project Update id",
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
        return $this->projectUpdateService->show($id);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/project-update/create",
     *      tags={"Project Update"},
     *      summary="Create project update",
     *      description="Add a new project update",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ProjectUpdate")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Comment",
     *          @OA\JsonContent(ref="#/components/schemas/ProjectUpdate")
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
    public function create(ProjectUpdateCreateRequest $request)
    {
        return $this->projectUpdateService->create($request);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/project-update/update",
     *      tags={"Project Update"},
     *      summary="Update Project update",
     *      description="Update of project update",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ProjectUpdateUpdate")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProjectUpdateUpdate")
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
    public function update(ProjectUpdateUpdateRequest $request)
    {
        return $this->projectUpdateService->update($request);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/project-update/delete/{id}",
     *      tags={"Project Update"},
     *      summary="Delete project update by Id",
     *      description="Delete project update by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Update Id",
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
        return $this->projectUpdateService->delete($id);
    }
}