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
            UserSeeder::class,
            TarifSeeder::class,
            TarifFeatureSeeder::class,
            TarifUserSeeder::class,
            TypeCampaignSeeder::class,
            CampaignSeeder::class,
            CampaignFeatureSeeder::class,
            SocialSeeder::class,
            SocialPostSeeder::class,
            // LandingPageSeeder::class,
            ImageSeeder::class,
            PromptSeeder::class,
            FeatureSeeder::class,
            CategorySeeder::class,
            CampaignTemplatesSeeder::class,
            TemplateTagsSeeder::class,
            TemplateRatingsSeeder::class,
            TemplateUsesSeeder::class,
            TemplateSocialPostSeeder::class,
            CampaignInteractionSeeder::class,
        ]);
    }
}
