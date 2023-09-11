<?php

namespace App\Http\Repository;

use App\Models\File;
use App\Models\Project;
use DateTime;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class ProjectRepository extends CommonRepository
{
    public function __construct()
    {
        parent::__construct();
        //
    }

    public static function index($request)
    {
        return Project::when($request->phase, function ($q) use ($request) {
            $q->where('phase', $request->phase);
        })
            ->when($request->user_id, function ($q) use ($request) {
                $q->where('created_by', $request->user_id);
            })
            ->paginate(config('constant.pagination_records'));
    }

    public static function store($request)
    {
        $userId = auth()->user()->id;
        $project = new Project();
        $project_no = rand(100000, 999999);
        $project->project_name = $request->project_name;
        $project->project_subtitle = $request->project_subtitle;
        $project->project_no = $project_no;
        $project->category_id = $request->category_id;
        $project->country_id = $request->country_id;
        $project_start_date = DateTime::createFromFormat('Y-m-d', $request->project_start_date)->format('Y-m-d');
        $project->project_start_date = $project_start_date;
        $project_end_date = DateTime::createFromFormat('Y-m-d', $request->project_end_date)->format('Y-m-d');
        $project->project_end_date = $project_end_date;
        $campaign_start_date = DateTime::createFromFormat('Y-m-d', $request->campaign_start_date)->format('Y-m-d');
        $project->campaign_start_date = $campaign_start_date;
        $campaign_end_date = DateTime::createFromFormat('Y-m-d', $request->campaign_end_date)->format('Y-m-d');
        $project->campaign_end_date = $campaign_end_date;
        $project->story = $request->story;
        $project->risks = $request->risks;
        $project->target_amount = $request->target_amount ? $request->target_amount : 0;
        $project->min_donation_amount = $request->min_donation_amount ? $request->min_donation_amount : 0;
        $project->currency_id = $request->currency_id;
        $project->donation_type = $request->donation_type;
        $project->created_by = $userId;
        $project->intro_video = $request->intro_video;
        $project->save();
        /*   if ($request->has('intro_video')) {
        $intro_video = $request->file('intro_video');

        $uniqueName = md5($intro_video->getClientOriginalName() . time()) . '.' . $intro_video->extension();
        $file = env('FILE_PATH_VIDEO') . $uniqueName;
        if (!file_exists(env('FILE_PATH_VIDEO'))) {
        mkdir(env('FILE_PATH_VIDEO'), 0777, true);
        }
        $contents = file_get_contents($intro_video);
        file_put_contents($file, $contents);
        $uploaded_file = new UploadedFile($file, $uniqueName);
        $file = new File([
        'file_type' => 'test',
        'file_name' => $uniqueName,
        'extension' => $uploaded_file->extension(),
        'path' => 'upload/videos/' .
        $uniqueName,
        'created_by' => $userId,
        ]);
        $project->files()->create($file->toArray());
        $project->intro_video = $project->files[0]->file_name;
        $project->update();
        } */
        return $project;
    }

    public static function findById($id)
    {
        return Project::find($id);
    }

    public static function updatePhase($project, $request)
    {
        $project->phase = $request->phase;
        $project->update();
        return $project;
    }

    public static function update($request, $project)
    {
        $userId = auth()->user()->id;
        if ($request->has('project_name')) {
            $project->project_name = $request->project_name;
        }

        if ($request->has('category_id')) {
            $project->category_id = $request->category_id;
        }
        if ($request->has('project_start_date')) {
            $project->project_start_date = $request->project_start_date;
        }
        if ($request->has('project_end_date')) {
            $project->project_end_date = $request->project_end_date;
        }
        if ($request->has('campaign_start_date')) {
            $project->campaign_start_date = $request->campaign_start_date;
        }
        if ($request->has('campaign_end_date')) {
            $project->campaign_end_date = $request->campaign_end_date;
        }
        if ($request->has('phase')) {
            $project->phase = $request->phase;
        }
        if ($request->has('story')) {
            $project->story = $request->story;
        }
        if ($request->has('risks')) {
            $project->risks = $request->risks;
        }
        if ($request->has('target_amount')) {
            $project->target_amount = $request->target_amount;
        }
        if ($request->has('min_donation_amount')) {
            $project->min_donation_amount = $request->min_donation_amount;
        }
        if ($request->has('currency_id')) {
            $project->currency_id = $request->currency_id;
        }
        if ($request->has('donation_type')) {
            $project->donation_type = $request->donation_type;
        }
        $project->modified_by = $userId;
        $project->update();

        if ($request->has('intro_video')) {
            $intro_video = $request->file('intro_video');

            $uniqueName = md5($intro_video->getClientOriginalName() . time()) . '.' . $intro_video->extension();
            $file = env('FILE_PATH_VIDEO') . $uniqueName;
            if (!file_exists(env('FILE_PATH_VIDEO'))) {
                mkdir(env('FILE_PATH_VIDEO'), 0777, true);
            }
            $contents = file_get_contents($intro_video);
            file_put_contents($file, $contents);
            $uploaded_file = new UploadedFile($file, $uniqueName);
            $file_1 = new File([
                'file_type' => 'test',
                'file_name' => $uniqueName,
                'extension' => $uploaded_file->extension(),
                'path' => 'upload/videos/' .
                $uniqueName,
                'created_by' => $userId,
            ]);
            $existFile = File::where('file_name', '=', $project->intro_video)
                ->first();
            if ($existFile) {
                unlink(env('FILE_PATH_VIDEO') . $project->intro_video);
                $project->files()->update($file_1->toArray());
            } else {
                $project->files()->create($file_1->toArray());
            }
        }
        return $project;
    }

    public static function delete($project)
    {
        $userId = auth()->user()->id;
        DB::beginTransaction();
        try {
            $project->delete();
            $file = File::where('fileable_id', $project->id)->get()
                ->first();
            if ($file) {
                unlink(env('FILE_PATH_VIDEO') . $project->intro_video);
                $file->delete();
            }
            $project->deleted_by = $userId;
            $project->update();
            DB::commit();
            return $project;
        } catch (Exception $exception) {
            DB::rollback();
            return $exception;
        }
    }

    public static function uploadImage($project, $request)
    {
        $userId = auth()->user()->id;
        DB::beginTransaction();
        try {
            if ($request->has('image')) {
                $image = $request->file('image');
                $uniqueName = md5($image->getClientOriginalName() . time()) . '.' . $image->extension();
                $file = env('FILE_PATH_PROJECT_IMAGE') . $uniqueName;
                if (!file_exists(env('FILE_PATH_PROJECT_IMAGE'))) {
                    mkdir(env('FILE_PATH_PROJECT_IMAGE'), 0777, true);
                }
                $contents = file_get_contents($image);
                file_put_contents($file, $contents);
                $uploaded_file = new UploadedFile($file, $uniqueName);
                $createFile = new File([
                    'file_type' => 'test',
                    'file_name' => $uniqueName,
                    'extension' => $uploaded_file->extension(),
                    'path' => env('FILE_PATH_PROJECT_IMAGE') .
                    $uniqueName,
                    'created_by' => $userId,
                ]);
                $project->files()->create($createFile->toArray());
                DB::commit();
                return $project;
            }
        } catch (Exception $exception) {
            dd("666");
            DB::rollback();
            return $exception;
        }
        dd("5555");
    }
}
