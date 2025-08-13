<?php

namespace Database\Factories;

use App\Models\CampaignTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignTemplateFactory extends Factory
{
    protected $model = CampaignTemplate::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'category' => $this->faker->randomElement(['sales', 'launch', 'engagement', 'visibility', 'branding', 'promotion']),
            'type_campaign_id' => 1,
            'author' => $this->faker->name(),
            'thumbnail' => $this->faker->imageUrl(400, 200),
            'preview' => $this->faker->text(100),
            'is_premium' => $this->faker->boolean(30),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
