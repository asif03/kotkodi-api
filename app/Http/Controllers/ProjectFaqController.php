<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectFaqCreateRequest;
use App\Http\Requests\ProjectFaqUpdateRequest;
use App\Http\Service\ProjectFaqService;
use Illuminate\Http\Request;

class ProjectFaqController extends Controller
{
    public $projectFaqService;

    public function __construct(ProjectFaqService $projectFaqService)
    {
        $this->projectFaqService = $projectFaqService;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/faq/list",
     *      tags={"Project Faq"},
     *      summary="Get list of FAQs of Projects",
     *      description="Returns list of faqs",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      security={{"Token": {}}}
     *     )
     */
    public function index(Request $request)
    {
        return $this->projectFaqService->index($request);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/faq/project/{id}",
     *      tags={"Project Faq"},
     *      summary="Show FAQ by Project ID",
     *      description="Show Project FAQs by Project Id",
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
        return $this->projectFaqService->listByProject($id);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/faq/show/{id}",
     *      tags={"Project Faq"},
     *      summary="Show FAQ Info",
     *      description="Show Project FAQ Info by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project FAQ id",
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
        return $this->projectFaqService->show($id);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/faq/create",
     *      tags={"Project Faq"},
     *      summary="Create project faqs",
     *      description="Add a new faq",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ProjectFAQ")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Comment",
     *          @OA\JsonContent(ref="#/components/schemas/ProjectFAQ")
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
    public function create(ProjectFaqCreateRequest $request)
    {
        return $this->projectFaqService->create($request);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/faq/update",
     *      tags={"Project Faq"},
     *      summary="Update Faq",
     *      description="Update Faq",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateFAQ")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UpdateFAQ")
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

    public function update(ProjectFaqUpdateRequest $request)
    {
        return $this->projectFaqService->update($request);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/faq/delete/{id}",
     *      tags={"Project Faq"},
     *      summary="Delete FAQ by Id",
     *      description="Delete FAQ by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Faq Id",
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
        return $this->projectFaqService->delete($id);
    }

}