<?php

namespace App\Http\Repository;

use Spatie\Permission\Models\Permission;

class PermissionRepository extends CommonRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function index()
    {
        return Permission::all();
    }
}