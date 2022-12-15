<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'view-userManagement',
            'create-userManagement',
            'edit-userManagement',
            'delete-userManagement',
            'view-role',
            'create-role',
            'edit-role',
            'show-role',
            'delete-role',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        ;
    }
}