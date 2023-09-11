<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankAccountCreateRequest extends FormRequest
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
            'account_type'  => 'required|max:50',
            'account_no'    => 'required|max:20',
            'account_title' => 'required|max:50',
            'bank_name'     => 'required|max:50',
            'branch_name'   => 'required|max:50',
            'swift_code'    => 'required|max:20',
        ];
    }
}