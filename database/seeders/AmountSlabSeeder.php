<?php

namespace Database\Seeders;

use App\Models\AmountSlab;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmountSlabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AmountSlab::truncate();
        $data = [
            [
                'id'                  => 1,
                'project_id'          => 1,
                'start_amount'        => 5,
                'end_amount'          => 9,
                'backer_fixed_gain'   => 2,
                'backer_percent_gain' => 1,
                'created_by'          => 1,
            ],
            [
                'id'                  => 2,
                'project_id'          => 1,
                'start_amount'        => 10,
                'end_amount'          => 19,
                'backer_fixed_gain'   => 5,
                'backer_percent_gain' => 3,
                'created_by'          => 1,
            ],
            [
                'id'                  => 3,
                'project_id'          => 1,
                'start_amount'        => 20,
                'end_amount'          => 100,
                'backer_fixed_gain'   => 10,
                'backer_percent_gain' => 10,
                'created_by'          => 1,
            ],
            [
                'id'                  => 4,
                'project_id'          => 2,
                'start_amount'        => 5,
                'end_amount'          => 9,
                'backer_fixed_gain'   => 2,
                'backer_percent_gain' => 1,
                'created_by'          => 1,
            ],
            [
                'id'                  => 5,
                'project_id'          => 2,
                'start_amount'        => 10,
                'end_amount'          => 19,
                'backer_fixed_gain'   => 5,
                'backer_percent_gain' => 3,
                'created_by'          => 1,
            ],
            [
                'id'                  => 6,
                'project_id'          => 2,
                'start_amount'        => 20,
                'end_amount'          => 100,
                'backer_fixed_gain'   => 10,
                'backer_percent_gain' => 10,
                'created_by'          => 1,
            ],
        ];

        DB::table('amount_slabs')->insert($data);
    }
}