<?php

namespace Database\Seeders;

use App\Models\TarifUser;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            CampaignSeeder::class,
            TypeCampaignSeeder::class,
            FeatureSeeder::class,
            SocialSeeder::class,
            TarifUserSeeder::class,
            TarifFeatureSeeder::class,
            TarifSeeder::class,
            UserSeeder::class,
        ]);
    }
}
