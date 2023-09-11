<?php

namespace App\Http\Service;

use App\Http\Repository\ProjectFaqRepository;
use App\Http\Resources\ProjectFaqCollection;
use App\Http\Resources\ProjectFaqResource;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Response;

class ProjectFaqService
{
    use RespondsWithHttpStatus;

    public function index($request)
    {
        $request->merge([
            'created_by' => auth()->user()->id,
        ]);
        $projectFaqs = ProjectFaqRepository::index($request);
        return $this->success(new ProjectFaqCollection($projectFaqs), Response::HTTP_OK);
    }

    public function listByProject($id)
    {
        $projectFaqs = ProjectFaqRepository::listByProject($id);
        return $this->success(new ProjectFaqCollection($projectFaqs), Response::HTTP_OK);
    }

    public function show($id)
    {
        $projectFaq = ProjectFaqRepository::findById($id);

        if (!$projectFaq) {
            return $this->failure(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(new ProjectFaqResource($projectFaq), Response::HTTP_OK);
    }

    /**
     * @OA\Schema(
     *      schema="ProjectFAQ",
     *      title="Create Project FAQ",
     *      description="Project FAQ create request body",
     *      type="object",
     *      required={"project_id", "question", "answer"},
     *      @OA\Property(
     *          property="project_id",
     *          description="Id of a project",
     *          example="1",
     *          type="integer"
     *      ),
     *      @OA\Property(
     *          property="question",
     *          description="Question of FAQ",
     *          example="What is the poject status?",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="answer",
     *          description="Answer of FAQ",
     *          example="Answer of FAQ.",
     *          type="string"
     *      )
     * )
     */
    public function create($request)
    {

        $faq = ProjectFaqRepository::store($request);

        if ($faq) {
            return $this->success(trans('messages.create'), Response::HTTP_CREATED);
        }

    }

    /**
     * @OA\Schema(
     *      schema="UpdateFAQ",
     *      title="Update Project FAQ",
     *      description="Project FAQ update request body",
     *      type="object",
     *      required={"id", "project_id", "question", "answer"},
     *      @OA\Property(
     *          property="id",
     *          description="ID of FAQ",
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
     *          property="question",
     *          description="Question of FAQ",
     *          example="What is the poject status?",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="answer",
     *          description="Answer of FAQ",
     *          example="Answer of FAQ.",
     *          type="string"
     *      )
     * )
     */
    public function update($request)
    {
        $faq = ProjectFaqRepository::findById($request->id);

        if (!$faq) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        if ($faq) {
            $isUpdate = ProjectFaqRepository::update($request, $faq);

            if ($isUpdate) {
                return $this->success(trans('messages.update'), Response::HTTP_OK);
            }

        }

    }

    public function delete($id)
    {
        $projectFaq = ProjectFaqRepository::findById($id);

        if (!$projectFaq) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(ProjectFaqRepository::delete($projectFaq));
    }

}