<?php

namespace App\Http\Repository;

use App\Models\Currency;

class CurrencyRepository extends CommonRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function index()
    {
        return Currency::all();
    }

    public static function store($request)
    {
        return Currency::create($request->all());
    }

    public static function update($request, $currency)
    {
        if ($request->has('currency_name')) {
            $currency->currency_name = $request->currency_name;
        }
        if ($request->has('currency_code')) {
            $currency->currency_code = $request->currency_code;
        }
        if ($request->has('is_active')) {
            $currency->is_active = $request->is_active == 1 ? 1 : 0;
        }
        return $currency->update();
    }

    public static function show($id)
    {
        $currency = Currency::findOrFail($id);

        return $currency;
    }

    public static function delete($currency)
    {
        return $currency->delete();
    }

    public static function findById($id)
    {
        return Currency::find($id);
    }
}