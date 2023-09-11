<?php

namespace App\Http\Service;

use App\Http\Repository\CurrencyRepository;
use App\Http\Resources\CurrencyCollection;
use App\Http\Resources\CurrencyResource;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Response;

class CurrencyService
{
    use RespondsWithHttpStatus;

    public function index()
    {
        $currency = CurrencyRepository::index();
        return $this->success(new CurrencyCollection($currency), Response::HTTP_OK);
    }

    /**
     * @OA\Schema(
     *      schema="Currency",
     *      title="Currency",
     *      description="Currency create request body",
     *      type="object",
     *       @OA\Property(
     *          property="currency_name",
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
        $currency = CurrencyRepository::store($request);

        if ($currency) {
            return $this->success(trans('messages.create'), Response::HTTP_CREATED);
        }
    }

    /**
     * @OA\Schema(
     *      schema="UpdateCurrency",
     *      title="Update Currency",
     *      description="Currency update request body",
     *      type="object",
     *     @OA\Property(
     *          property="id",
     *          description="ID of currency",
     *          example="2",
     *          type="integer"
     *      ),
     *       @OA\Property(
     *          property="currency_name",
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
        $currency = CurrencyRepository::findById($request->id);

        if (!$currency) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        if ($currency) {
            $isUpdate = CurrencyRepository::update($request, $currency);
            if ($isUpdate) {
                return $this->success(trans('messages.update'), Response::HTTP_OK);
            }
        }
    }

    public function show($id)
    {
        $currency = CurrencyRepository::findById($id);
        if (!$currency) {
            return $this->failure(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(new CurrencyResource($currency), Response::HTTP_OK);
    }

    public function delete($id)
    {
        $currency = CurrencyRepository::findById($id);
        if (!$currency) {
            return $this->failure(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(CurrencyRepository::delete($currency));
    }
}