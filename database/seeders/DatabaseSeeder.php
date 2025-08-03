<?php

namespace Database\Seeders;

use App\Models\CampaignFeatures;
use App\Models\Image;
use App\Models\LandingPage;
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
        $this->call([
            UserSeeder::class,
            TarifUserSeeder::class,
            TarifFeatureSeeder::class,
            TarifSeeder::class,
            CampaignFeatureSeeder::class,
            TypeCampaignSeeder::class,
            CampaignSeeder::class,
            SocialSeeder::class,
            SocialPostSeeder::class,
            LandingPageSeeder::class,
            ImageSeeder::class,
            PromptSeeder::class,
            FeatureSeeder::class,
        ]);
    }
}
