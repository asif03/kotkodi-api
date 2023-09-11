<?php

namespace App\Http\Service;

use App\Http\Repository\AmountSlabRepository;
use App\Http\Repository\ProjectRepository;
use App\Http\Resources\AmountSlabCollection;
use App\Http\Resources\AmountSlabResource;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Response;

class AmountSlabService
{
    use RespondsWithHttpStatus;

    public function index($project_id)
    {
        $amountSlab = AmountSlabRepository::index($project_id);
        return $this->success(new AmountSlabCollection($amountSlab), Response::HTTP_OK);
    }

    /**
     * @OA\Schema(
     *      schema="AmountSlab",
     *      title="AmountSlab",
     *      description="AmountSlab create request body",
     *      type="object",
     *      required={"project_id", "start_amount", "end_amount"},
     *      @OA\Property(
     *          property="project_id",
     *          description="Project Id",
     *          example="1",
     *          type="integer"
     *      ),
     *       @OA\Property(
     *          property="start_amount",
     *          description="Start amount",
     *          example="20",
     *          type="double"
     *      ),
     *       @OA\Property(
     *          property="end_amount",
     *          description="End amount",
     *          example="29",
     *          type="double"
     *      ),
     *       @OA\Property(
     *          property="backer_fixed_gain",
     *          description="Backer fixed gain",
     *          example="5",
     *          type="double"
     *      ),
     *      @OA\Property(
     *          property="backer_percent_gain",
     *          description="Backer percent gain",
     *          example="2",
     *          type="double"
     *      )
     * )
     */
    public function create($request)
    {
        $project = ProjectRepository::findById($request->project_id);
        if (!$project) {
            return $this->failure(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        if ($project->phase != 'INIT') {
            return $this->failure(trans('messages.noUpdate'));
        }

        if ($project->donation_type == null) {
            return $this->failure(trans('messages.donation_type_not_empty'));
        }

        if ($project->donation_type == 'fixed' && $request->backer_fixed_gain <= 0) {
            return $this->failure(trans('messages.backer_fixed_gain'));
        }

        if ($project->donation_type == 'percentage' && $request->backer_percent_gain <= 0) {
            return $this->failure(trans('messages.backer_percent_gain'));
        }

        $amountSlab = AmountSlabRepository::store($request, $project);

        if ($amountSlab) {
            return $this->success(trans('messages.create'), Response::HTTP_CREATED);
        }
    }

    /**
     * @OA\Schema(
     *      schema="UpdateAmountSlab",
     *      title="UpdateAmountSlab",
     *      description="AmountSlab update request body",
     *      type="object",
     *      @OA\Property(
     *          property="id",
     *          description="Amount slab Id",
     *          example="1",
     *          type="integer"
     *      ),
     *       @OA\Property(
     *          property="start_amount",
     *          description="Start amount",
     *          example="20",
     *          type="double"
     *      ),
     *       @OA\Property(
     *          property="end_amount",
     *          description="End amount",
     *          example="29",
     *          type="double"
     *      ),
     *       @OA\Property(
     *          property="backer_fixed_gain",
     *          description="Backer fixed gain",
     *          example="5",
     *          type="double"
     *      ),
     *      @OA\Property(
     *          property="backer_percent_gain",
     *          description="Backer percent gain",
     *          example="2",
     *          type="double"
     *      )
     * )
     */

    public function update($request)
    {
        $amountSlab = AmountSlabRepository::findById($request->id);

        if (!$amountSlab) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        $project = ProjectRepository::findById($amountSlab->project_id);

        if ($project->phase != 'INIT') {
            return $this->failure(trans('messages.noUpdate'));
        }

        if ($amountSlab) {
            $isUpdate = AmountSlabRepository::update($request, $amountSlab, $project);
            if ($isUpdate) {
                return $this->success(trans('messages.update'), Response::HTTP_OK);
            }
        }
    }

    public function show($id)
    {
        $amountSlab = AmountSlabRepository::findById($id);
        if (!$amountSlab) {
            return $this->failure(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(new AmountSlabResource($amountSlab), Response::HTTP_OK);
    }

    public function delete($id)
    {
        $amountSlab = AmountSlabRepository::findById($id);
        if (!$amountSlab) {
            return $this->failure(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        $project = ProjectRepository::findById($amountSlab->project_id);

        if ($project->phase != 'INIT') {
            return $this->failure(trans('messages.noDelete'));
        }

        return $this->success(AmountSlabRepository::delete($amountSlab));
    }
}
