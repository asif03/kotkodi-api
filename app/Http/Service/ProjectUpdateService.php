<?php

namespace App\Http\Service;

use App\Http\Repository\ProjectUpdateRepository;
use App\Http\Resources\ProjectUpdateCollection;
use App\Http\Resources\ProjectUpdateResource;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Response;

class ProjectUpdateService
{
    use RespondsWithHttpStatus;

    public function index($request)
    {
        $request->merge([
            'created_by' => auth()->user()->id,
        ]);
        $projectUpdates = ProjectUpdateRepository::index($request);
        return $this->success(new ProjectUpdateCollection($projectUpdates), Response::HTTP_OK);
    }

    public function listByProject($id)
    {
        $projectUpdates = ProjectUpdateRepository::listByProject($id);
        return $this->success(new ProjectUpdateCollection($projectUpdates), Response::HTTP_OK);
    }

    public function show($id)
    {
        $projectUpdate = ProjectUpdateRepository::findById($id);

        if (!$projectUpdate) {
            return $this->failure(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(new ProjectUpdateResource($projectUpdate), Response::HTTP_OK);
    }

    /**
     * @OA\Schema(
     *      schema="ProjectUpdate",
     *      title="Create Project Update",
     *      description="Project Update create request body",
     *      type="object",
     *      required={"project_id", "description"},
     *      @OA\Property(
     *          property="project_id",
     *          description="Id of a project",
     *          example="1",
     *          type="integer"
     *      ),
     *      @OA\Property(
     *          property="description",
     *          description="Description of Project Update",
     *          example="Early Access is Open for 24 Hours!",
     *          type="string"
     *      )
     * )
     */
    public function create($request)
    {
        $projectUpdate = ProjectUpdateRepository::store($request);

        if ($projectUpdate) {
            return $this->success(trans('messages.create'), Response::HTTP_CREATED);
        }

    }

    /**
     * @OA\Schema(
     *      schema="ProjectUpdateUpdate",
     *      title="Update Project Update",
     *      description="Project Update update request body",
     *      type="object",
     *      required={"id", "project_id", "description"},
     *      @OA\Property(
     *          property="id",
     *          description="Id of a project update",
     *          example="1",
     *          type="integer"
     *      ),
     *      @OA\Property(
     *          property="project_id",
     *          description="Id of a project",
     *          example="1",
     *          type="integer"
     *      ),
     *      @OA\Property(
     *          property="description",
     *          description="Description of Project Update",
     *          example="Early Access is Open for 24 Hours!",
     *          type="string"
     *      )
     * )
     */
    public function update($request)
    {
        $projectUpdate = ProjectUpdateRepository::findById($request->id);

        if (!$projectUpdate) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        if ($projectUpdate) {
            $isUpdate = ProjectUpdateRepository::update($request, $projectUpdate);

            if ($isUpdate) {
                return $this->success(trans('messages.update'), Response::HTTP_OK);
            }

        }

    }

    public function delete($id)
    {
        $projectUpdate = ProjectUpdateRepository::findById($id);

        if (!$projectUpdate) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(ProjectUpdateRepository::delete($projectUpdate));
    }

}