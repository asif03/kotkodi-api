<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryCreateRequest;
use App\Http\Requests\CountryUpdateRequest;
use App\Http\Service\CountryService;

class CountryController extends Controller
{
    public $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
        $this->middleware('permission:country-list|country-create|country-edit|country-delete', ['only' => ['create', 'show', 'update', 'delete']]);
        /*  $this->middleware('permission:country-create', ['only' => ['create','store']]);
    $this->middleware('permission:country-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:country-delete', ['only' => ['delete']]); */
    }

    /**
     * @OA\Get(
     *      path="/api/v1/country/list",
     *      tags={"Country"},
     *      summary="Get list of country",
     *      description="Returns list of country",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function index()
    {
        return $this->countryService->index();
    }

    /**
     * @OA\Get(
     *      path="/api/v1/currency/list",
     *      tags={"Currency"},
     *      summary="Get list of currency",
     *      description="Returns list of currency",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */
    public function currencyList()
    {
        return $this->countryService->currencyList();
    }

    /**
     * @OA\Post(
     *      path="/api/v1/country/create",
     *      tags={"Country"},
     *      summary="Create country",
     *      description="Add new country",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Country")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Country",
     *          @OA\JsonContent(ref="#/components/schemas/Country")
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
    public function create(CountryCreateRequest $request)
    {
        return $this->countryService->create($request);
    }
    /**
     * @OA\Put(
     *      path="/api/v1/country/update",
     *      tags={"Country"},
     *      summary="Update country",
     *      description="Update country",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCountry")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCountry")
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
    public function update(CountryUpdateRequest $request)
    {
        return $this->countryService->update($request);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/country/show/{id}",
     *      tags={"Country"},
     *      summary="Show Country Info",
     *      description="Show Country Info by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Country id",
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
        return $this->countryService->show($id);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/country/delete/{id}",
     *      tags={"Country"},
     *      summary="Delete Country by Id",
     *      description="Delete Country by Id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Country Id",
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
        return $this->countryService->delete($id);
    }
}
