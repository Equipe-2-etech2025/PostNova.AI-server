<?php

namespace Database\Factories;

use App\Models\Social;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SocialPost>
 */
class SocialPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
            'social_id' => Social::factory(),
        ];
    }
}
