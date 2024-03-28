<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User
        Permission::create(['name'  => 'view-users']);
        Permission::create(['name'  => 'create-users']);
        Permission::create(['name'  => 'store-users']);
        Permission::create(['name'  => 'edit-users']);
        Permission::create(['name'  => 'update-users']);
        Permission::create(['name'  => 'delete-users']);
        Permission::create(['name'  => 'change-role-users']);

        // Role
        Permission::create(['name'  => 'view-role']);
        Permission::create(['name'  => 'create-role']);
        Permission::create(['name'  => 'store-role']);
        Permission::create(['name'  => 'edit-role']);
        Permission::create(['name'  => 'update-role']);
        Permission::create(['name'  => 'delete-role']);

        // Pemission
        Permission::create(['name'  => 'view-permission']);
        Permission::create(['name'  => 'create-permission']);
        Permission::create(['name'  => 'store-permission']);
        Permission::create(['name'  => 'edit-permission']);
        Permission::create(['name'  => 'update-permission']);
        Permission::create(['name'  => 'delete-permission']);
    }
}
