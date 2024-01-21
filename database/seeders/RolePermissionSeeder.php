<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name'  => 'tambah-user']);
        Permission::create(['name'  => 'edit-user']);
        Permission::create(['name'  => 'hapus-user']);

        Permission::create(['name'  => 'tambah-undangan']);
        Permission::create(['name'  => 'lihat-undangan']);
        Permission::create(['name'  => 'edit-undangan']);
        Permission::create(['name'  => 'hapus-undangan']);

        $roleSuperAdmin = Role::create(['name' => 'super-admin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleKaryawan = Role::create(['name' => 'karyawan']);

        $roleAdmin->givePermissionTo('tambah-user');
        $roleAdmin->givePermissionTo('edit-user');
        $roleAdmin->givePermissionTo('hapus-user');
        $roleAdmin->givePermissionTo('tambah-undangan');
        $roleAdmin->givePermissionTo('lihat-undangan');
        $roleAdmin->givePermissionTo('edit-undangan');
        $roleAdmin->givePermissionTo('hapus-undangan');

        $roleKaryawan->givePermissionTo('tambah-undangan');
        $roleKaryawan->givePermissionTo('lihat-undangan');
        $roleKaryawan->givePermissionTo('edit-undangan');
        $roleKaryawan->givePermissionTo('hapus-undangan');
    }
}
