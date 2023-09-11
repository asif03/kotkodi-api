<?php

namespace App\Http\Repository;

use App\Models\ProjectUpdate;

class ProjectUpdateRepository extends CommonRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function index($request)
    {
        return ProjectUpdate::when($request->user_id, function ($q) use ($request) {
            $q->where('created_by', $request->user_id);
        })->paginate(config('constant.pagination_records'));
    }

    public static function listByProject($id)
    {
        return ProjectUpdate::where('project_id', $id)->paginate(config('constant.pagination_records'));
    }

    public static function findById($id)
    {
        return ProjectUpdate::find($id);
    }

    public static function store($request)
    {
        return ProjectUpdate::create(array_merge($request->all(), ['created_by' => auth()->user()->id]));
    }

    public static function update($request, $projectUpdate)
    {

        if ($request->has('project_id')) {
            $projectUpdate->project_id = $request->project_id;
        }

        if ($request->has('description')) {
            $projectUpdate->description = $request->description;
        }

        if ($request->has('is_active')) {
            $projectUpdate->is_active = $request->is_active == 1 ? 1 : 0;
        }

        $projectUpdate->updated_by = auth()->user()->id;

        return $projectUpdate->update();
    }

    public static function delete($projectUpdate)
    {
        return $projectUpdate->delete();
    }

}