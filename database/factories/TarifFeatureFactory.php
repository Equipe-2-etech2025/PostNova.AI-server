<?php

namespace Database\Factories;

use App\Models\TarifFeature;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TarifFeature>
 */
class TarifFeatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = TarifFeature::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $features = [
            '3 quotas par jour',
            'Génération image',
            'Génération video',
            'Génération landing page',
            'Génération publication',
            'Domaine plus précis',
            'Génération de contenu IA illimitée',
            'Export en formats multiples',
            'Support email 24/7',
            'Publication automatique sur les réseaux sociaux',
            'Analytics avancées et rapports détaillés',
            'Intégrations API personnalisées',
            'Templates personnalisables',
            'Collaboration en équipe',
            'Planification de posts',
            'Voix off automatique avec ElevenLabs',
            'Montage vidéo automatique',
            'Landing pages optimisées SEO',
            'A/B testing intégré',
            'Webhooks personnalisés',
            'Support prioritaire',
            'Formation personnalisée',
            'Sauvegarde automatique',
            'Historique des versions'
        ];

        return [
            'content' => $this->faker->randomElement($features),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => function (array $attributes) {
                return $this->faker->dateTimeBetween($attributes['created_at'], 'now');
            },
        ];
    }

    /**
     * Indicate that the feature is recent.
     */
    public function recent(): static
    {
        return $this->state(fn (array $attributes) => [
            'created_at' => now()->subHours(rand(1, 23)),
            'updated_at' => now()->subMinutes(rand(1, 59)),
        ]);
    }

    /**
     * Indicate that the feature is old.
     */
    public function old(): static
    {
        return $this->state(fn (array $attributes) => [
            'created_at' => now()->subMonths(rand(6, 12)),
            'updated_at' => now()->subMonths(rand(1, 5)),
        ]);
    }
}
