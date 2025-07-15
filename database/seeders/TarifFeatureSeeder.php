<?php

namespace Database\Seeders;

use App\Models\TarifFeature;
use Illuminate\Database\Seeder;

class TarifFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            // Features Starter
            'Génération de contenu IA pour tous les réseaux sociaux',
            'Génération image automatique avec IA',
            'Génération landing page inclus',
            'Support email standard',
            'Jusqu\'à 3 campagnes par jour',

            // Features Pro
            'Publication automatique sur les réseaux sociaux',
            'Analytics avancées et rapports détaillés',
            'Campagnes illimités',
            'Support prioritaire',
            'Planification de posts',
        ];

        foreach ($features as $feature) {
            TarifFeature::create([
                'content' => $feature,
            ]);
        }

        // Créer quelques features supplémentaires avec la factory
        TarifFeature::factory(5)->create();
    }
}
