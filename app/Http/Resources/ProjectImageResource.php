<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $imageUrl = null;
        $fileName = null;
        $extension = null;
        $fileId = null;
        if (isset($this->files)) {
            if (isset($this->files) && count($this->files) > 0) {
                $imageUrl = $this->files->last()->path;
                $fileId = $this->files->last()->id;
                $fileName = $this->files->last()->file_name;
                $extension = $this->files->last()->extension;
            }
        }
        return [
            'projectId' => $this->id,
            'projectName' => $this->project_name,
            'projectNo' => $this->project_no,
            'categoryId' => $this->category_id,
            'fileId' => $fileId,
            'fileName' => $fileName,
            'extension' => $extension,
            'url' =>  env('BASE_URL') . $imageUrl,
        ];
    }
}
