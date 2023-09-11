<?php

namespace App\Http\Controllers;

use App\Http\Service\PermissionService;

class PermissionController extends Controller
{
    public $roleService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        return $this->permissionService->index();
    }
}