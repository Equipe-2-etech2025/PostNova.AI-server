<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CampaignFeatures;
use App\Models\Campaign;
use App\Models\Features;

class CampaignFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CampaignFeatures::truncate();

        $campaigns = Campaign::all();
        $features = Features::all();

        // Si vide, créer quelques exemples
        if ($campaigns->isEmpty()) {
            $campaigns = Campaign::factory()->count(3)->create();
        }

        if ($features->isEmpty()) {
            $features = Features::factory()->count(3)->create();
        }

        foreach ($campaigns as $campaign) {
            $selectedFeatures = $features->random(2);

            foreach ($selectedFeatures as $feature) {
                CampaignFeatures::create([
                    'campaign_id' => $campaign->id,
                    'feature_id' => $feature->id,
                ]);
            }
        }
    }
}
