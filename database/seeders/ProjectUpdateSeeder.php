<?php

namespace Database\Seeders;

use App\Models\ProjectUpdate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectUpdate::truncate();
        $data = [
            [
                'id'          => 1,
                'description' => "Hope that everyone had a lovely Memorial Day weekend! This month has been surreal seeing Homiah finally come to life. I'm sharing the exciting progress we've made since our public launch this month. Plus, I'll also be offering a backer only chance to get your hands on Burmese products like Pickled Tea Leaves and Crispy Beans today.",
                'project_id'  => 1,
                'created_by'  => 1,
            ],
            [
                'id'          => 2,
                'description' => "Early Access is Open for 24 Hours!",
                'project_id'  => 1,
                'created_by'  => 1,
            ],
            [
                'id'          => 3,
                'description' => "Heyo friends! After only 86 hours Paper Animal RPG is fully funded. You guys are absolutely amazing and I'm incredibly thankful for each and everyone of you and your support. I'm very much looking forward to the further development of Paper Animal RPG and I will try my very best not to disappoint and make the game as good as it can be!!!",
                'project_id'  => 2,
                'created_by'  => 1,
            ],
            [
                'id'          => 4,
                'description' => "First of all, from the bottom of my heart thanks to every one of you! I have been blown away by your support and love for the project and I’m incredibly glad and happy that you all like it so much!!:) In under 6 hours we’re already 50% funded, this is absolutely amazing (and unreal lol):D",
                'project_id'  => 2,
                'created_by'  => 1,
            ],
        ];

        DB::table('project_updates')->insert($data);
    }
}