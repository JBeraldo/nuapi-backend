<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->call([
            AdminSeeder::class,
            RoleSeeder::class
        ]);

        User::factory()
            ->count(10)
            ->create()
            ->each(function ($user) {
                $user->assignRole('Professor');
            });
    }
}
