<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TarifFeature;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TarifFeature>
 */
class TarifFeatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TarifFeature::class;

    public function definition(): array
    {
        return [
            'name' => fake()->sentence(4),
        ];
    }
}
