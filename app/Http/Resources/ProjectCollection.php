<?php

namespace App\Http\Resources;

use App\Traits\PaginationTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectCollection extends ResourceCollection
{

    private $pagination, $link;
    use PaginationTrait;

    public function __construct($resource)
    {
        $this->pagination = $this->getPaginationArray($resource);
        $this->link = $this->getLinkArray($resource);
        $resource = $resource->getCollection();
        parent::__construct($resource);
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => ProjectResource::collection($this->collection),
            'pagination' => $this->pagination,
            'links' => $this->link,
        ];
    }
}
