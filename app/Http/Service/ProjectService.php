<?php

namespace App\Http\Service;

use App\Http\Repository\FileRepository;
use App\Http\Repository\ProjectRepository;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectImageResource;
use App\Http\Resources\ProjectResource;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectService
{
    use RespondsWithHttpStatus;
    public function index($request)
    {
        $project = ProjectRepository::index($request);
        return $this->success(new ProjectCollection($project), Response::HTTP_OK);
    }

    public function listByUser($request)
    {

        $request->merge([
            'user_id' => auth()->user()->id,
        ]);
        $project = ProjectRepository::index($request);
        return $this->success(new ProjectCollection($project), Response::HTTP_OK);
    }

    public function liveProjectList($request)
    {
        $request->merge([
            'phase' => "LIVE",
        ]);
        $project = ProjectRepository::index($request);
        return $this->success(new ProjectCollection($project), Response::HTTP_OK);
    }

    /**
     * @OA\Schema(
     *      schema="CreateProject",
     *      title="Project Create",
     *      description="Project create request body",
     *      type="object",
     *      required={"project_name", "category_id", "country_id", "project_start_date", "project_end_date", "campaign_start_date", "campaign_end_date", "intro_video"},
     *      @OA\Property(
     *          property="project_name",
     *          description="Name of project",
     *          example="Blood donor",
     *          type="string"
     *      ),
     *       @OA\Property(
     *          property="project_subtitle",
     *          description="Sub-title of project",
     *          example="Stay fit and eat right and donate blood",
     *          type="mediumText"
     *      ),
     *       @OA\Property(
     *          property="category_id",
     *          description="Category id",
     *          example="1",
     *          type="integer"
     *      ),
     *        @OA\Property(
     *           property="country_id",
     *           description="Country/Location Id",
     *           example="1",
     *           type="integer"
     *        ),
     *         @OA\Property(
     *             property="project_start_date",
     *             description="Project start date",
     *             example="2022-08-15",
     *             type="date"
     *            ),
     *          @OA\Property(
     *               property="project_end_date",
     *               description="Project end date",
     *               example="2022-09-15",
     *               type="date"
     *            ),
     *           @OA\Property(
     *                property="campaign_start_date",
     *                description="Campaign start date",
     *                example="2022-09-16",
     *                type="date"
     *            ),
     *           @OA\Property(
     *               property="campaign_end_date",
     *               description="Campaign end date",
     *               example="2022-09-30",
     *                type="date"
     *             ),
     *             @OA\Property(
     *                 property="story",
     *                 description="Project story",
     *                  example="This project for funding <b>money</b>.",
     *                  type="string"
     *              ),
     *               @OA\Property(
     *                   property="risks",
     *                   description="Project risks",
     *                   example="This project for funding <b>money</b>.",
     *                   type="string"
     *                 ),
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
     *                  @OA\Property(
     *                      property="intro_video",
     *                      description="video url",
     *                      example="https://www.youtube.com/watch?v=KeDElA1p4y0",
     *                      type="string"
     *                  ),
     * )
     */
    public function create($request)
    {

        $project = ProjectRepository::store($request);
        if ($project) {
            return $this->success(new ProjectResource($project), Response::HTTP_CREATED);
        }
    }

    /**
     * @OA\Schema(
     *      schema="ProjectStatusUpdate",
     *      title="Update Project Status/Phase request",
     *      description="Updated Project request body",
     *      type="object",
     *      required={"phase"},
     *      @OA\Property(
     *          property="phase",
     *          description="Project status/phase",
     *          example="INIT",
     *          type="string"
     *      )
     * )
     */

    public function updatePhase($request, $id)
    {
        $project = ProjectRepository::findById($id);

        if (!$project) {
            return $this->failure(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        $isUpdated = ProjectRepository::updatePhase($project, $request);
        if ($isUpdated) {
            return $isUpdated;
        }
    }

    public function show($id)
    {
        $project = ProjectRepository::findById($id);

        if (!$project) {
            return $this->failure(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(new ProjectResource($project), Response::HTTP_OK);
    }

    public function update($request)
    {
        $project = ProjectRepository::findById($request->id);

        if (!$project) {
            return $this->failure(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        if ($project) {
            if ($project->phase != 'INIT') {
                return $this->failure(trans('messages.noUpdate'));
            }
            $isUpdate = ProjectRepository::update($request, $project);
            if ($isUpdate) {
                return $this->success(new ProjectResource($isUpdate), Response::HTTP_OK);
            }
        }
    }

    public function delete($id)
    {

        $project = ProjectRepository::findById($id);

        if (!$project) {
            return $this->failure(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        if ($project->phase != 'INIT') {
            return $this->failure(trans('messages.noDelete'));
        }
        if (!$project) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(ProjectRepository::delete($project));
    }

    public function uploadImage($request)
    {
        $project = ProjectRepository::findById($request->project_id);
        if (!$project) {
            return $this->failure(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }
        if ($project->phase != 'INIT') {
            return $this->failure(trans('messages.noUpdate'));
        }

        $uploadImage = ProjectRepository::uploadImage($project, $request);
        if ($uploadImage) {
            return $this->success(new ProjectImageResource($uploadImage), Response::HTTP_CREATED);
        }
    }

    public function deleteImage($request, $id)
    {
        $project = ProjectRepository::findById($request->project_id);

        if (!$project) {
            return $this->failure(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        if ($project->phase != 'INIT') {
            return $this->failure(trans('messages.noDelete'));
        }
        $file = FileRepository::findById($id);
        if (!$file) {
            return $this->failure(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }
        return $this->success(FileRepository::delete($file));
    }
}
