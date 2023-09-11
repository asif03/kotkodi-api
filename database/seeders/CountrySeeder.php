<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::truncate();
        $data = [
            [
                'id' => 1,
                'name' => 'AFGHANISTAN',
                'code' => 'AF',
                'iso_code' => '971',
                'currency' => 'Afghani',
                'currency_code' => 'AFN',
                'created_by' => 1
            ],
            [
                'id' => 2,
                'name' => 'ALBANIA',
                'code' => 'AL',
                'iso_code' => '008',
                'currency' => 'Lek',
                'currency_code' => 'ALL',
                'created_by' => 1
            ],
            [
                'id' => 3,
                'name' => 'BANGLADESH',
                'code' => 'BD',
                'iso_code' => '050',
                'currency' => 'Taka',
                'currency_code' => 'BDT',
                'created_by' => 1
            ],
            [
                'id' => 4,
                'name' => 'UNITED STATES OF AMERICA',
                'code' => 'US',
                'iso_code' => '840',
                'currency' => 'US Dollar',
                'currency_code' => 'USD',
                'created_by' => 1
            ],
            [
                'id' => 5,
                'name' => 'India',
                'code' => 'IN',
                'iso_code' => '356',
                'currency' => 'Indian Rupee',
                'currency_code' => 'INR',
                'created_by' => 1
            ]
        ];

        DB::table('countries')->insert($data);
    }
}
