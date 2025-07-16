<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarif>
 */
class TarifFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement(['Free', 'Pro']);
        return [
            'name' => $name,
            'amount' => $name === 'Free' ? 0.00 : 14.99,
            'max_limit' => $name === 'Free' ? 3 : 30
        ];
    }
}
