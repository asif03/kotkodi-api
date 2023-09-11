<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::truncate();
        $data = [
            [
                'id'                  => 1,
                'project_name'        => 'Southeast Asian Pantry',
                'project_subtitle'    => 'This is project subtitle',
                'project_no'          => 1,
                'category_id'         => 1,
                'project_start_date'  => date('Y-m-d'),
                'project_end_date'    => date("Y-m-d", strtotime("+1 month", strtotime(date('Y-m-d')))),
                'campaign_start_date' => date('Y-m-d'),
                'campaign_end_date'   => date("Y-m-d", strtotime("+1 month", strtotime(date('Y-m-d')))),
                'phase'               => 'INIT',
                'intro_video'         => '',
                'story'               => "We deliver curated spice kits and relishes to your door so you can make iconic Southeast Asian dishes to feed friends & family. All you need to do is provide the protein & veggies and follow our step-by-step recipes. Shipped in Homiah’s gorgeous gift-ready boxes.",
                'risks'               => "Risks and challenges I planned the game's budget carefully and also created a development roadmap that allows for eventual delays if something unexpected should happen.",
                'target_amount'       => 40489,
                'min_donation_amount' => 5,
                'currency_id'         => 1,
                'donation_type'       => 'fixed',
                'country_id'            => 1,
                'created_by'          => 1,
            ]
        ];

        DB::table('projects')->insert($data);
    }
}
