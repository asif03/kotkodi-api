<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectCreateRequest extends FormRequest
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
            'project_name'      => 'required|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'project_start_date'      => 'required|date',
            'project_end_date'  =>  'required|date',
            'campaign_start_date'  =>  'required|date',
            'campaign_end_date'  =>  'required|date',
           /*  'story'      => 'required',
            'risks'      => 'required',
            'target_amount' => 'required|numeric|min:1',
            'min_donation_amount' => 'required|numeric|min:1',
            'currency_id' => 'required|integer|exists:categories,id', */
            'country_id' => 'required|integer|exists:countries,id',
          /*   'donation_type'      => 'required', */
           // 'intro_video' => 'required|file|max:1000000',
            'intro_video' => 'required',
        ];
    }
}
