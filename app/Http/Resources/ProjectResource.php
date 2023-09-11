<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /* $videoUrl = null;
        $fileType = null;
        $fileName = null;
        $extension = null;
        if (isset($this->files)) {
            if (isset($this->files) && count($this->files) > 0) {
                $videoUrl = $this->files[0]->path;
                $fileType = $this->files[0]->file_type;
                $fileName = $this->files[0]->file_name;
                $extension = $this->files[0]->extension;
            }
        } */
        return [
            'id' => $this->id,
            'projectName' => $this->project_name,
            'project_subtitle' => $this->project_subtitle,
            'projectNo' => $this->project_no,
            'categoryId' => $this->category_id,
            'countryId' => $this->country_id,
            'projectStartDate' => $this->project_start_date,
            'projectEndDate' => $this->project_end_date,
            'campaignStartDate' => $this->campaign_start_date,
            'campaignEndDate' => $this->campaign_end_date,
            'phase' => $this->phase,
            'story' => $this->story,
            'risks' => $this->risks,
            'targetAmount' => $this->target_amount,
            'minDonationAmount' => $this->min_donation_amount,
            'currencyId' => $this->currency_id,
            'donationType' => $this->donation_type,
            'videoUrl' =>  $this->intro_video,
            /* 'video' => [
                'url' => $videoUrl,
                'fileType' => $fileType,
                'fileName' => $fileName,
                'extension' => $extension,
            ], */


        ];
    }
}
