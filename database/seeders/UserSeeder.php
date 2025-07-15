<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory()
            ->count(10)
            ->sequence(fn()  => [
                'role' => 'user',
            ])
            ->create();
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@postnova.ai',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);
    }
}
