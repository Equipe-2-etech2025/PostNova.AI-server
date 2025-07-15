<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tarifs = Tarif::factory()->count(5)->create();

        User::factory()
            ->count(10)
            ->sequence(fn()  => [
                'role' => 'user',
                'tarif_user_id' => $tarifs->random()->id,
            ])
            ->create();
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@postnova.ai',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'tarif_user_id' => null,
        ]);
    }
}
