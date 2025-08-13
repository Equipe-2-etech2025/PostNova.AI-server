<?php

namespace Database\Factories;

use App\Models\TemplateUse;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemplateUseFactory extends Factory
{
    protected $model = TemplateUse::class;

    public function definition()
    {
        return [
            'template_id' => 1, // à remplir dans le seeder
            'used_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
