<?php

namespace App\Http\Repository;

use App\Models\Country;

class CountryRepository extends CommonRepository
{
    public function __construct()
    {
        parent::__construct();
        //
    }

    public static function index()
    {
        return Country::all();
    }

    public static function currencyList()
    {
        return Country::where("currency", '!=', "")->get();
    }

    public static function store($request)
    {

        return Country::create($request->all());
    }

    public static function update($request, $country)
    {

        if ($request->has('name')) {
            $country->name = $request->name;
        }

        if ($request->has('code')) {
            $country->code = $request->code;
        }

        if ($request->has('iso_code')) {
            $country->iso_code = $request->iso_code;
        }

        if ($request->has('currency')) {
            $country->currency = $request->currency;
        }

        if ($request->has('currency_code')) {
            $country->currency_code = $request->currency_code;
        }

        if ($request->has('is_active')) {
            $country->is_active = $request->is_active == 1 ? 1 : 0;
        }

        return $country->update();
    }

    public static function show($id)
    {
        $country = Country::findOrFail($id);

        return $country;
    }

    public static function delete($country)
    {
        return $country->delete();
    }

    public static function findById($id)
    {
        return Country::find($id);
    }
}
