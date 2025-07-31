<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;
use App\Models\Campaign;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Image::class;

    public function definition(): array
    {
        return [
            'path' => 'https://picsum.photos/seed/' . fake()->uuid . '/640/480',
            'is_published' => fake()->boolean(),
            'campaign_id' => rand(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
