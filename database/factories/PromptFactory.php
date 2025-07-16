<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Prompt;
use App\Models\Campaign;
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
            'content' => fake()->paragraph(),
            'campaign_id' => Campaign::inRandomOrder()->first()?->id ?? Campaign::factory(),
            'created_at' => now(),
        ];
    }
}
