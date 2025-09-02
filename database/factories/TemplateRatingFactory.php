<?php

namespace Database\Factories;

use App\Models\TemplateRating;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemplateRatingFactory extends Factory
{
    protected $model = TemplateRating::class;

    public function definition()
    {
        return [
            'template_id' => 1, // à remplir dans le seeder selon les templates
            'rating' => $this->faker->randomFloat(1, 3, 5), // note entre 3 et 5
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
