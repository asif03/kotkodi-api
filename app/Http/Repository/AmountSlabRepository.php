<?php

namespace App\Http\Repository;

use App\Models\AmountSlab;

class AmountSlabRepository extends CommonRepository
{
    public function __construct()
    {
        parent::__construct();
        //
    }

    public static function index($project_id)
    {
        return AmountSlab::where('project_id', $project_id)->get();
    }

    public static function store($request, $project)
    {
        $amountSlab = new AmountSlab();
        $amountSlab->project_id = $request->project_id;
        $amountSlab->start_amount = $request->start_amount;
        $amountSlab->end_amount = $request->end_amount;
        if ($project->donation_type == 'fixed') {
            $amountSlab->backer_fixed_gain = $request->backer_fixed_gain;
        }

        if ($project->donation_type == 'percentage') {
            $amountSlab->backer_percent_gain = $request->backer_percent_gain;
        }

        if ($project->donation_type == 'mixed') {
            $amountSlab->backer_fixed_gain = $request->backer_fixed_gain;
            $amountSlab->backer_percent_gain = $request->backer_percent_gain;
        }
        $amountSlab->created_by = auth()->user()->id;
        return $amountSlab->save();
    }

    public static function update($request, $amountSlab, $project)
    {
        if ($request->has('start_amount')) {
            $amountSlab->start_amount = $request->start_amount;
        }
        if ($request->has('end_amount')) {
            $amountSlab->end_amount = $request->end_amount;
        }
        if ($project->donation_type == 'fixed' && $request->has('backer_fixed_gain')) {
            $amountSlab->backer_fixed_gain = $request->backer_fixed_gain;
        }

        if ($project->donation_type == 'percentage' && $request->has('backer_percent_gain')) {
            $amountSlab->backer_percent_gain = $request->backer_percent_gain;
        }

        if ($project->donation_type == 'mixed') {
            if ($request->has('backer_fixed_gain')) {
                $amountSlab->backer_fixed_gain = $request->backer_fixed_gain;
            }
            if ($request->has('backer_percent_gain')) {
                $amountSlab->backer_percent_gain = $request->backer_percent_gain;
            }
        }
        return $amountSlab->update();
    }

    public static function delete($amountSlab)
    {
        return $amountSlab->delete();
    }

    public static function findById($id)
    {
        return AmountSlab::find($id);
    }
}
