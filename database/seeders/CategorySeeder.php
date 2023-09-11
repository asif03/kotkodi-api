<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        $data = [
            [
                'id'            => 1,
                'category_name' => 'Arts',
            ],
            [
                'id'            => 2,
                'category_name' => 'Comics & Illustration',
            ],
            [
                'id'            => 3,
                'category_name' => 'Design & Tech',
            ],
            [
                'id'            => 4,
                'category_name' => 'Film',
            ],
            [
                'id'            => 5,
                'category_name' => 'Food & Craft',
            ],
        ];

        DB::table('categories')->insert($data);
    }
}