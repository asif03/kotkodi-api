<?php

namespace App\Http\Service;

use App\Http\Repository\CountryRepository;
use App\Http\Resources\CountryCollection;
use App\Http\Resources\CountryResource;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Response;

class CountryService
{
    use RespondsWithHttpStatus;

    public function index()
    {
        $country = CountryRepository::index();
        return $this->success(new CountryCollection($country), Response::HTTP_OK);
    }

    public function currencyList()
    {
        $country = CountryRepository::currencyList();
        return $this->success(new CountryCollection($country), Response::HTTP_OK);
    }

    /**
     * @OA\Schema(
     *      schema="Country",
     *      title="Country",
     *      description="Country create request body",
     *      type="object",
     *      required={"name", "code", "email", "iso_code"},
     *      @OA\Property(
     *          property="name",
     *          description="Name of country",
     *          example="Bangladesh",
     *          type="string"
     *      ),
     *       @OA\Property(
     *          property="code",
     *          description="Country code",
     *          example="888",
     *          type="string"
     *      ),
     *       @OA\Property(
     *          property="iso_code",
     *          description="ISO Code",
     *          example="888",
     *          type="string"
     *      ),
     *       @OA\Property(
     *          property="currency",
     *          description="Currency",
     *          example="Taka",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="currency_code",
     *          description="Currency Code",
     *          example="255",
     *          type="string"
     *      )
     * )
     */
    public function create($request)
    {
        $request->merge([
            'created_by' => auth()->user()->id
        ]);
        $country = CountryRepository::store($request);

        if ($country) {
            return $this->success(trans('messages.create'), Response::HTTP_CREATED);
        }
    }

    /**
     * @OA\Schema(
     *      schema="UpdateCountry",
     *      title="Update Country",
     *      description="Country update request body",
     *      type="object",
     *     @OA\Property(
     *          property="id",
     *          description="ID of country",
     *          example="2",
     *          type="integer"
     *      ),
     *      @OA\Property(
     *          property="name",
     *          description="Name of country",
     *          example="Bangladesh",
     *          type="string"
     *      ),
     *       @OA\Property(
     *          property="code",
     *          description="Country code",
     *          example="888",
     *          type="string"
     *      ),
     *       @OA\Property(
     *          property="iso_code",
     *          description="ISO Code",
     *          example="888",
     *          type="string"
     *      ),
     *       @OA\Property(
     *          property="currency",
     *          description="Currency",
     *          example="Taka",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="currency_code",
     *          description="Currency Code",
     *          example="255",
     *          type="string"
     *      )
     * )
     */
    public function update($request)
    {
        $country = CountryRepository::findById($request->id);

        if (!$country) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        if ($country) {
            $isUpdate = CountryRepository::update($request, $country);
            if ($isUpdate) {
                return $this->success(trans('messages.update'), Response::HTTP_OK);
            }
        }
    }

    public function show($id)
    {
        $country = CountryRepository::findById($id);
        if (!$country) {
            return $this->failure(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(new CountryResource($country), Response::HTTP_OK);
    }

    public function delete($id)
    {
        $country = CountryRepository::findById($id);
        if (!$country) {
            return $this->failure(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(CountryRepository::delete($country));
    }
}
