<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\LandingPage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LandingPage>
 */
class LandingPageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = LandingPage::class;

    public function definition(): array
    {
        return [
            'content' => [
                'hero' => [
                    'title' => $this->faker->sentence(4),
                    'subtitle' => $this->faker->sentence(6),
                    'background_image' => $this->faker->imageUrl(),
                ],
                'features' => [
                    [
                        'icon' => $this->faker->imageUrl(),
                        'title' => $this->faker->words(3, true),
                        'description' => $this->faker->sentence(8),
                    ],
                    [
                        'icon' => $this->faker->imageUrl(),
                        'title' => $this->faker->words(3, true),
                        'description' => $this->faker->sentence(8),
                    ],
                ],
                'cta' => [
                    'label' => 'Commencez maintenant',
                    'url' => $this->faker->url(),
                ],
                'testimonials' => [
                    [
                        'author' => $this->faker->name(),
                        'quote' => $this->faker->sentence(10),
                    ],
                ],
                'footer' => [
                    'text' => '© 2025 MonEntreprise',
                    'links' => [
                        ['label' => 'Mentions légales', 'url' => $this->faker->url()],
                        ['label' => 'CGU', 'url' => $this->faker->url()],
                    ],
                ],
            ],
            'is_published' => $this->faker->boolean(),
            'campaign_id' => Campaign::inRandomOrder()->first()?->id ?? Campaign::factory(),
        ];
    }
}
