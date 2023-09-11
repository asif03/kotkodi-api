<?php

namespace App\Http\Service;

use App\Http\Repository\PermissionRepository;
use App\Http\Resources\PermissionCollection;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Response;

class PermissionService
{
    use RespondsWithHttpStatus;

    public function index()
    {
        $permission = PermissionRepository::index();
        return $this->success(new PermissionCollection($permission), Response::HTTP_OK);
    }

}