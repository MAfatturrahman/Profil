<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create([
            'name' => 'SuperAdmin',
            'guard_name' => 'web'
        ]);

        $Admin = Role::create([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);

        $superAdmin->givePermissionTo([
            'view-userManagement',
            'create-userManagement',
            'edit-userManagement',
            'delete-userManagement',
            'view-role',
            'create-role',
            'edit-role',
            'show-role',
            'delete-role',
        ]);

        $Admin->givePermissionTo([
            'view-userManagement',
        ]);
    }
}