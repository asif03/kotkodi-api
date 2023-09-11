<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'country-list',
            'country-create',
            'country-edit',
            'country-delete',

            'category-create',
            'category-edit',
            'category-delete',
            'category-show',

            'bank-account-list',
            'bank-account-create',
            'bank-account-edit',
            'bank-account-delete',
            'bank-account-show',

            'comment-list',
            'comment-create',
            'comment-edit',
            'comment-delete',
            'comment-show',

            'project-list',
            'project-create',
            'project-edit',
            'project-delete',
            'project-show',
            'project-phase-update',
            'project-image-upload',
            'project-image-delete',

            'amount-slab-list',
            'amount-slab-create',
            'amount-slab-edit',
            'amount-slab-delete',
            'amount-slab-show',

            'faq-list',
            'faq-create',
            'faq-edit',
            'faq-delete',
            'faq-show',

            'project-update-list',
            'project-update-create',
            'project-update-edit',
            'project-update-delete',
            'project-update-show',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}