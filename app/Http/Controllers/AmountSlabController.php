<?php

namespace App\Http\Controllers;

use App\Http\Requests\AmountSlabCreateRequest;
use Illuminate\Http\Request;
use App\Http\Service\AmountSlabService;

class AmountSlabController extends Controller
{
    public $amountSlabService;
    public function __construct(AmountSlabService $amountSlabService)
    {
        $this->amountSlabService = $amountSlabService;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/project/amount-slab/list/{project_id}",
     *      tags={"Project Amount Slab"},
     *      summary="Get list of Amount Slab",
     *      description="Returns list of Amount Slab",
     *      @OA\Parameter(
     *          name="project_id",
     *          description="Project id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      security={{"Token": {}}}
     *     )
     */

    public function index($project_id)
    {
        return $this->amountSlabService->index($project_id);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/project/amount-slab/create",
     *      tags={"Project Amount Slab"},
     *      summary="Create Amount slab",
     *      description="Add new Amount slab",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/AmountSlab")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="AmountSlab",
     *          @OA\JsonContent(ref="#/components/schemas/AmountSlab")
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
    public function create(AmountSlabCreateRequest $request)
    {
        return $this->amountSlabService->create($request);
    }

    /**
     * @OA\Put(
     *      path="/api/v1/project/amount-slab/update",
     *      tags={"Project Amount Slab"},
     *      summary="Update Amount slab",
     *      description="Update Amount slab",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateAmountSlab")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="AmountSlab",
     *          @OA\JsonContent(ref="#/components/schemas/AmountSlab")
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
    public function update(Request $request)
    {
        return $this->amountSlabService->update($request);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/project/amount-slab/show/{id}",
     *      tags={"Project Amount Slab"},
     *      summary="Show Amount Slab",
     *      description="Show Amount Slab by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Amount Slab id",
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
        return $this->amountSlabService->show($id);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/project/amount-slab/delete/{id}",
     *      tags={"Project Amount Slab"},
     *      summary="Delete Amount Slab by Id",
     *      description="Delete Amount Slab by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Amount Slab Id",
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
        return $this->amountSlabService->delete($id);
    }
}
