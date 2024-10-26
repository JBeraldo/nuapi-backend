<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test2@example.com',
            'cpf' => '00000000000',
            'password' => Hash::make('senha123'),
            'is_active' => true,
        ]);
    }
}
