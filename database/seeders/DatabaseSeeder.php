<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Model::unguard();
        $this->call([
            PermissionTableSeeder::class,
            RoleSeeder::class,
            UsersSeeder::class,
            BankAccountSeeder::class,
            CountrySeeder::class,
            CategorySeeder::class,
            ProjectSeeder::class,
            CommentSeeder::class,
            ProjectFAQSeeder::class,
            ProjectUpdateSeeder::class,
            AmountSlabSeeder::class,
        ]);

        Model::reguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}