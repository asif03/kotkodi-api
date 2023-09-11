<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\ProjectPhaseUpdateRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Service\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/project/list",
     *      tags={"Project"},
     *      summary="Get list of Project",
     *      description="Returns list of Project",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      security={{"Token": {}}}
     *     )
     */
    public function index(Request $request)
    {
        return $this->projectService->index($request);
    }
    /**
     * @OA\Get(
     *      path="/api/v1/project/my/list",
     *      tags={"Project"},
     *      summary="User's project list",
     *      description="Returns list of User's project",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      security={{"Token": {}}}
     *     )
     */
    public function listByUser(Request $request)
    {
        return $this->projectService->listByUser($request);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/project/live-project-list",
     *      tags={"Project"},
     *      summary="Get list of live project",
     *      description="Returns list of live project",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *     )
     */
    public function liveProjectList(Request $request)
    {
        return $this->projectService->liveProjectList($request);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/project/createOld",
     *      tags={"Project"},
     *      summary="Create project",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  required={"project_name","category_id", "country_id", "project_start_date", "project_end_date", "campaign_start_date", "campaign_end_date", "intro_video"},
     *                  @OA\Property(
     *                      property="project_name",
     *                      description="Project name",
     *                      example="Blood donar",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="project_subtitle",
     *                      description="Project sub title",
     *                      example="abcd",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="category_id",
     *                      description="Category Id",
     *                      example="1",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="country_id",
     *                      description="Country/Location Id",
     *                      example="1",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="project_start_date",
     *                      description="Project start date",
     *                      example="2022-08-15 12:00:00",
     *                      type="date"
     *                  ),
     *                  @OA\Property(
     *                      property="project_end_date",
     *                      description="Project end date",
     *                      example="2022-09-15 12:00:00",
     *                      type="date"
     *                  ),
     *                  @OA\Property(
     *                      property="campaign_start_date",
     *                      description="Campaign start date",
     *                      example="2022-09-16 12:00:00",
     *                      type="date"
     *                  ),
     *                  @OA\Property(
     *                      property="campaign_end_date",
     *                      description="Campaign end date",
     *                      example="2022-09-30 12:00:00",
     *                      type="date"
     *                  ),
     *                  @OA\Property(
     *                      property="story",
     *                      description="Project story",
     *                      example="This project for funding <b>money</b>.",
     *                      type="string"
     *                  ),
     *                 @OA\Property(
     *                      property="risks",
     *                      description="Project risks",
     *                      example="This project for funding <b>money</b>.",
     *                      type="string"
     *                  ),
     *                 @OA\Property(
     *                      property="target_amount",
     *                      description="Project target amount",
     *                      example="5000",
     *                      type="double"
     *                  ),
     *                 @OA\Property(
     *                      property="min_donation_amount",
     *                      description="Min donation_amount amount",
     *                      example="100",
     *                      type="double"
     *                  ),
     *                @OA\Property(
     *                      property="currency_id",
     *                      description="Currency Id",
     *                      example="1",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="donation_type",
     *                      description="Project donation type: fixed,percentage,mixed",
     *                      example="fixed",
     *                      type="string"
     *                  ),
     *                    @OA\Property(
     *                      property="intro_video",
     *                      type="file",
     *                      type="string",
     *                      format="binary"
     *                  ),
     *              )
     *          )
     *      ),

     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      security={{"Token": {}}}
     * )
     */

    public function createOld(ProjectCreateRequest $request)
    {
        return $this->projectService->create($request);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/project/create",
     *      tags={"Project"},
     *      summary="Create project",
     *      description="Create new project",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CreateProject")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Project",
     *          @OA\JsonContent(ref="#/components/schemas/CreateProject")
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
     *      security={{"Token": {}}}
     * )
     */
    public function create(ProjectCreateRequest $request)
    {
        return $this->projectService->create($request);
    }

    /**
     * @OA\Put(
     *      path="/api/v1/project/updatePhase/{id}",
     *      tags={"Project"},
     *      summary="Update Project Status/Phase",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ProjectStatusUpdate")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      security={{"Token": {}}}
     * )
     */
    public function updatePhase(ProjectPhaseUpdateRequest $request, $id)
    {
        return $this->projectService->updatePhase($request, $id);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/project/show/{id}",
     *      tags={"Project"},
     *      summary="Show Project Info",
     *      description="Show Project Info by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project id",
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
        return $this->projectService->show($id);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/project/update",
     *      tags={"Project"},
     *      summary="Update project",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="id",
     *                      description="Project Id",
     *                      example="1",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="project_name",
     *                      description="Project name",
     *                      example="Blood donar",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="category_id",
     *                      description="Category Id",
     *                      example="1",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="project_start_date",
     *                      description="Project start date",
     *                      example="2022-08-15 12:00:00",
     *                      type="date"
     *                  ),
     *                  @OA\Property(
     *                      property="project_end_date",
     *                      description="Project end date",
     *                      example="2022-09-15 12:00:00",
     *                      type="date"
     *                  ),
     *                  @OA\Property(
     *                      property="campaign_start_date",
     *                      description="Campaign start date",
     *                      example="2022-09-16 12:00:00",
     *                      type="date"
     *                  ),
     *                  @OA\Property(
     *                      property="campaign_end_date",
     *                      description="Campaign end date",
     *                      example="2022-09-30 12:00:00",
     *                      type="date"
     *                  ),
     *                  @OA\Property(
     *                      property="phase",
     *                      description="Project phase/status: INIT, CAMPAIGN, PENDING, LIVE, COMPLETE, FAILED",
     *                      example="INIT",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="story",
     *                      description="Project story",
     *                      example="This project for funding <b>money</b>.",
     *                      type="string"
     *                  ),
     *                 @OA\Property(
     *                      property="risks",
     *                      description="Project risks",
     *                      example="This project for funding <b>money</b>.",
     *                      type="string"
     *                  ),
     *                 @OA\Property(
     *                      property="target_amount",
     *                      description="Project target amount",
     *                      example="5000",
     *                      type="double"
     *                  ),
     *                 @OA\Property(
     *                      property="min_donation_amount",
     *                      description="Min donation_amount amount",
     *                      example="100",
     *                      type="double"
     *                  ),
     *                @OA\Property(
     *                      property="currency_id",
     *                      description="Currency Id",
     *                      example="1",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="donation_type",
     *                      description="Project donation type: fixed,percentage,mixed",
     *                      example="fixed",
     *                      type="string"
     *                  ),
     *                    @OA\Property(
     *                      property="intro_video",
     *                      type="file",
     *                      type="string",
     *                      format="binary"
     *                  ),
     *              )
     *          )
     *      ),

     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      security={{"Token": {}}}
     * )
     */
    public function update(ProjectUpdateRequest $request)
    {
        return $this->projectService->update($request);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/project/delete/{id}",
     *      tags={"Project"},
     *      summary="Delete Project by Id",
     *      description="Delete Project by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project Id",
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
        return $this->projectService->delete($id);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/project/upload-image",
     *      tags={"Project"},
     *      summary="Upload image",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  required={"project_id", "image"},
     *                  @OA\Property(
     *                      property="project_id",
     *                      description="Project Id",
     *                      example="1",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="image",
     *                      type="file",
     *                      type="string",
     *                      format="binary"
     *                  ),
     *              )
     *          )
     *      ),

     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      security={{"Token": {}}}
     * )
     */

    public function uploadImage(ImageUploadRequest $request)
    {
        return $this->projectService->uploadImage($request);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/project/delete-image/{id}",
     *      tags={"Project"},
     *      summary="Delete Project Image by Id",
     *      description="Delete Project Image by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Image Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="project_id",
     *          description="Project Id",
     *          required=true,
     *          in="query",
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

    public function deleteImage(Request $request, $id)
    {
        return $this->projectService->deleteImage($request, $id);
    }
}
