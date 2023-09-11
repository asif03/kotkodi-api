<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BankAccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray( $request )
    {
        return [
            'id'            => $this->id,
            'userId'        => $this->user_id,
            'accountType'   => $this->account_type,
            'accountNumber' => $this->account_no,
            'accountTitle'  => $this->account_title,
            'bankName'      => $this->bank_name,
            'branchName'    => $this->branch_name,
            'swiftCode'     => $this->swift_code,
            'isActive'      => $this->is_active,
        ];
    }
}