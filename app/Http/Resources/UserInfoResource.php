<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $imageUrl = null;

        if (isset($this->files) && count($this->files) > 0) {
            $imageUrl = $this->files[0]->path;
        }

        return [
            'address_line1' => $this->address_line1,
            'address_line2' => $this->address_line2,
            'address_line3' => $this->address_line3,
            'phone_country_id' => $this->phone_country_id,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'imageUrl' => $imageUrl,
            'image' => [
                'url' => $imageUrl,
            ],
        ];
    }
}
