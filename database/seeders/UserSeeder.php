<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un admin par défaut
        User::create([
            'name' => 'Admin',
            'email' => 'admin@postnova.ai',
            'password' => Hash::make('password'),
            'role' => User::ROLE_ADMIN,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Créer un utilisateur normal par défaut
        User::create([
            'name' => 'Default User',
            'email' => 'user@postnova.ai',
            'password' => Hash::make('password'),
            'role' => User::ROLE_USER,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Créer des utilisateurs aléatoires
        User::factory(10)->create();
        User::factory(3)->admin()->create();
    }
}
