<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'          => 'required|string|unique:countries,name,NULL,id,deleted_at,NULL',
            'code'          => 'required|max:5',
            'iso_code'      => 'required|max:10',
        ];
    }
}
