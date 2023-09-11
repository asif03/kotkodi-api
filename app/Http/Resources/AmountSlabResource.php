<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AmountSlabResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'start_amount' => $this->start_amount,
            'end_amount' => $this->end_amount,
            'backer_fixed_gain' => $this->backer_fixed_gain,
            'backer_percent_gain' => $this->backer_percent_gain
        ];
    }
}
