<?php

namespace App\Http\Repository;

use App\Models\ProjectFaq;

class ProjectFaqRepository extends CommonRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function index($request)
    {
        return ProjectFaq::when($request->user_id, function ($q) use ($request) {
            $q->where('created_by', $request->user_id);
        })->paginate(config('constant.pagination_records'));
    }

    public static function listByProject($id)
    {
        return ProjectFaq::where('project_id', $id)->paginate(config('constant.pagination_records'));
    }

    public static function findById($id)
    {
        return ProjectFaq::find($id);
    }

    public static function store($request)
    {
        return ProjectFaq::create(array_merge($request->all(), ['created_by' => auth()->user()->id]));
    }

    public static function update($request, $faq)
    {

        if ($request->has('project_id')) {
            $faq->project_id = $request->project_id;
        }

        if ($request->has('question')) {
            $faq->question = $request->question;
        }

        if ($request->has('answer')) {
            $faq->answer = $request->answer;
        }

        if ($request->has('is_active')) {
            $faq->is_active = $request->is_active == 1 ? 1 : 0;
        }

        $faq->updated_by = auth()->user()->id;

        return $faq->update();
    }

    public static function delete($projectFaq)
    {
        return $projectFaq->delete();
    }

}