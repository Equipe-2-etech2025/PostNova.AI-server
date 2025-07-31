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
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_ADMIN,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Créer un utilisateur normal par défaut
        User::create([
            'name' => 'Lisa',
            'email' => 'lisa@gmail.com',
            'password' => Hash::make('lisapassword123'),
            'role' => User::ROLE_USER,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Créer un utilisateur normal par défaut
        User::create([
            'name' => 'Tahiry',
            'email' => 'tahiry@gmail.com',
            'password' => Hash::make('tahirypassword123'),
            'role' => User::ROLE_USER,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Andhi',
            'email' => 'andhi@gmail.com',
            'password' => Hash::make('andhipassword123'),
            'role' => User::ROLE_USER,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'nathan',
            'email' => 'nathan@gmail.com',
            'password' => Hash::make('nathanpassword123'),
            'role' => User::ROLE_USER,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
