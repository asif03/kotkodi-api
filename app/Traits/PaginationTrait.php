<?php

namespace App\Traits;

trait PaginationTrait
{
    public function getPaginationArray($resource)
    {
        return [
            'total' => $resource->total(),
            'count' => $resource->count(),
            'perPage' => $resource->perPage(),
            'currentPage' => $resource->currentPage(),
            'totalPages' => $resource->lastPage(),
            'path' => $resource->path(),
        ];
    }

    public function getLinkArray($resource)
    {
        return [
            'next' => $resource->nextPageUrl(),
            'prev' => $resource->previousPageUrl(),
            'first' => $resource->url(1),
            'last' => $resource->url($resource->lastPage()),
        ];
    }

}
