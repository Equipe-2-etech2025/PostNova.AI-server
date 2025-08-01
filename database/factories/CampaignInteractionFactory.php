<?php

namespace Database\Factories;

use App\Models\CampaignInteraction;
use App\Models\User;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignInteractionFactory extends Factory
{
    protected $model = CampaignInteraction::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'campaign_id' => Campaign::inRandomOrder()->first()?->id ?? Campaign::factory(),
            'views' => $this->faker->numberBetween(0, 50),
            'likes' => $this->faker->numberBetween(0, 20),
            'shares' => $this->faker->numberBetween(0, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
