<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BankAccount::truncate();
        $data = [
            [
                'id'            => 1,
                'user_id'       => 1,
                'account_type'  => 'SB',
                'account_no'    => '12345609',
                'account_title' => 'MD. SELIM REZA',
                'bank_name'     => 'Publi Bank Limited',
                'branch_name'   => 'Principal Branch',
                'swift_code'    => 'PUBABDDH201',
            ],
            [
                'id'            => 2,
                'user_id'       => 1,
                'account_type'  => 'SB',
                'account_no'    => '12345609',
                'account_title' => 'MD. AMAN ULLAH',
                'bank_name'     => 'AB Bank Limited',
                'branch_name'   => 'Principal Branch',
                'swift_code'    => 'ABBLBDDH201',
            ],
            [
                'id'            => 3,
                'user_id'       => 1,
                'account_type'  => 'SB',
                'account_no'    => '12345609',
                'account_title' => 'MD. JUBAYER',
                'bank_name'     => 'BRAC Bank Limited',
                'branch_name'   => 'Principal',
                'swift_code'    => 'BRAKBDDHXXX',
            ],
            [
                'id'            => 4,
                'user_id'       => 1,
                'account_type'  => 'SB',
                'account_no'    => '12345609',
                'account_title' => 'MD. RIADH',
                'bank_name'     => 'Dutch Bangla Bank Limited',
                'branch_name'   => 'Principal Branch',
                'swift_code'    => 'DBBLBDDH107',
            ],
        ];

        DB::table('bank_accounts')->insert($data);
    }
}