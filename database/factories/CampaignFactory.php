<?php

namespace Database\Factories;

use App\Models\TypeCampaign;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Campaign;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Campaign::class;

    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['pending', 'processing', 'completed', 'failed']),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'type_campaign_id' => TypeCampaign::inRandomOrder()->first()?->id ?? TypeCampaign::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
