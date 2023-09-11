<?php

namespace App\Http\Repository;

use Spatie\Permission\Models\Role;

class RoleRepository extends CommonRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function index()
    {
        return Role::all();
    }

    public static function store($request)
    {
        $roleInput = array(
            'name' => $request->get('name'),
        );
        $role = Role::create($roleInput);

        $role->syncPermissions($request->get('permission'));

        return $role;
    }

    public static function update($request, $role)
    {

        if ($request->has('name')) {
            $role->name = $request->name;
        }

        $updateRole = $role->update($request->only('name'));

        if ($updateRole) {
            $role->syncPermissions($request->get('permission'));
        }

        return $updateRole;
    }

    public static function show($id)
    {
        $role = Role::findOrFail($id);

        return $role;
    }

    public static function delete($role)
    {
        return $role->delete();
    }

    public static function findById($id)
    {
        return Role::find($id);
    }

}