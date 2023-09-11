<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $data = [
            [
                'id' => 1,
                'first_name' => 'Rafiqul Islam',
                'last_name' => 'Islam',
                'email' => 'mdrafiq10015@gmail.com',
                'user_name' => 'mdrafiq10015',
                'password' => app('hash')->make('12345678'),
                'is_active' => 1,
            ],
            [
                'id' => 2,
                'first_name' => 'Md. Shohag',
                'last_name' => 'Hossan',
                'email' => 'shohag.secs@gmail.com',
                'user_name' => 'shohag.secs',
                'password' => app('hash')->make('12345678'),
                'is_active' => 1,
            ],
            [
                'id' => 3,
                'first_name' => 'Md. Aman',
                'last_name' => 'Ullah',
                'email' => 'aman4.mi@gmail.com',
                'user_name' => 'aman4.mi',
                'password' => app('hash')->make('12345678'),
                'is_active' => 1,
            ],
            [
                'id' => 4,
                'first_name' => 'Md. Asif',
                'last_name' => 'Iqbal',
                'email' => 'babu033045@gmail.com',
                'user_name' => 'babu033045',
                'password' => app('hash')->make('12345678'),
                'is_active' => 1,
            ],
            [
                'id' => 5,
                'first_name' => 'Sayed golam rasul',
                'last_name' => 'riaydh',
                'email' => 'riaydh06@gmail.com',
                'user_name' => 'riaydh06',
                'password' => app('hash')->make('12345678'),
                'is_active' => 1,
            ],
            [
                'id' => 6,
                'first_name' => 'Md. Mofaqkhayrul',
                'last_name' => 'Islam Mim',
                'email' => 'mofaqkhayrul1202043@gmail.com',
                'user_name' => 'mofaqkhayrul1202043',
                'password' => app('hash')->make('12345678'),
                'is_active' => 1,
            ],
            [
                'id' => 7,
                'first_name' => 'MD JOBAYER MAHAMUD',
                'last_name' => 'SOZIB',
                'email' => 'jobayermahamudkamalcse@gmail.com',
                'user_name' => 'jobayermahamudkamalcse',
                'password' => app('hash')->make('12345678'),
                'is_active' => 1,
            ]
        ];
        DB::table('users')->insert($data);
    }
}
