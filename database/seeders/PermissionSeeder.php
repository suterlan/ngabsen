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
        Permission::create(['name'  => 'menu-undangan']);
        Permission::create(['name'  => 'menu-users']);
        Permission::create(['name'  => 'menu-roles']);
        Permission::create(['name'  => 'menu-permission']);
    }
}
