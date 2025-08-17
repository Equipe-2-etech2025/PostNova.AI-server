<?php

namespace Database\Factories;

use App\Models\TemplateTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemplateTagFactory extends Factory
{
    protected $model = TemplateTag::class;

    public function definition()
    {
        return [
            'template_id' => 1, // à remplir dans le seeder
            'tag' => $this->faker->word(),
        ];
    }
}
