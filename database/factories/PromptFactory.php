<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Prompt;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prompt>
 */
class PromptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Prompt::class;

    public function definition(): array
    {
        return [
            'content' => $content = $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
            'campaign_id' => Campaign::factory(),
        ];
    }
}
