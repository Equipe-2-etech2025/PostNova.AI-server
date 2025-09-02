<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\CampaignFeatures;
use App\Models\Features;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CampaignFeatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CampaignFeatures::class;

    public function definition(): array
    {
        return [
            'campaign_id' => Campaign::inRandomOrder()->first()?->id ?? Campaign::factory(),
            'feature_id' => Features::inRandomOrder()->first()?->id ?? Features::factory(),
        ];
    }
}
