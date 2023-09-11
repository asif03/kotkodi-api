<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::truncate();
        $data = [
            [
                'id'         => 1,
                'comment'    => 'I seriously cant wait, this is gonna be one hell of a journey',
                'project_id' => 1,
                'created_by' => 1,
            ],
            [
                'id'         => 2,
                'comment'    => 'Thank you for creating this project, I love the idea and being able to support you awesome creators! I do have some questions remaining: How many pages are planned for the material and add-on books? And will there be additional stretch goals and/or add-ons for more physical and digital goods?',
                'project_id' => 1,
                'created_by' => 1,
            ],
            [
                'id'         => 3,
                'comment'    => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
                'project_id' => 1,
                'created_by' => 1,
            ],
            [
                'id'         => 4,
                'comment'    => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
                'project_id' => 2,
                'created_by' => 1,
            ],
            [
                'id'         => 5,
                'comment'    => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
                'project_id' => 2,
                'created_by' => 1,
            ],
        ];

        DB::table('comments')->insert($data);
    }
}