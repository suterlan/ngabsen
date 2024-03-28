<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {

        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            JabatanSeeder::class,

        ]);

        $superadmin = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
        ]);
        $superadmin->assignRole('super-admin');

        $admin = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@gmail.com',
        ]);
        $admin->assignRole('admin');

        // $operator = \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'admin@admin.com',
        // ]);
        \App\Models\User::factory()->create()->assignRole('user');
        \App\Models\User::factory()->create()->assignRole('user');
        \App\Models\User::factory()->create()->assignRole('user');
        \App\Models\User::factory()->create()->assignRole('user');
        \App\Models\User::factory()->create()->assignRole('user');
        \App\Models\User::factory()->create()->assignRole('user');
        \App\Models\User::factory()->create()->assignRole('user');
        \App\Models\User::factory()->create()->assignRole('user');
        \App\Models\User::factory()->create()->assignRole('user');
        \App\Models\User::factory()->create()->assignRole('user');
    }
}
