<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Campaign;
use App\Models\TypeCampaign;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupère tous les IDs des utilisateurs existants
        $userIds = User::pluck('id')->toArray();

        // Récupère tous les IDs des types de campagne existants
        $typeCampaignIds = TypeCampaign::pluck('id')->toArray();

        $campaigns = [
            [
                'name' => 'Campagne pour la propreté urbaine',
                'description' => 'Cette campagne vise à sensibiliser les citoyens à l’importance de maintenir la propreté dans les rues de la ville.',
                'status' => 'pending',
            ],
            [
                'name' => 'Collecte de fonds pour les écoles rurales',
                'description' => 'Objectif : améliorer les conditions d’apprentissage dans les zones défavorisées.',
                'status' => 'processing',
            ],
            [
                'name' => 'Sensibilisation au tri des déchets',
                'description' => 'Une campagne éducative pour initier les habitants au tri sélectif et au recyclage.',
                'status' => 'completed',
            ],
            [
                'name' => 'Campagne de vaccination pour tous',
                'description' => 'Une initiative visant à assurer une couverture vaccinale complète dans les zones rurales et urbaines.',
                'status' => 'processing',
            ],
            [
                'name' => 'Campagne zéro plastique',
                'description' => 'Cette campagne encourage l’abandon des plastiques à usage unique au profit de solutions durables.',
                'status' => 'pending',
            ],
            [
                'name' => 'Accès à Internet pour les jeunes',
                'description' => 'Promotion de l’inclusion numérique à travers l’installation de bornes Wi-Fi gratuites dans les écoles publiques.',
                'status' => 'completed',
            ],
            [
                'name' => 'Soutien psychologique post-COVID',
                'description' => 'Des séances de soutien et d’écoute pour les personnes affectées émotionnellement par la pandémie.',
                'status' => 'processing',
            ],
            [
                'name' => 'Formation en compétences numériques',
                'description' => 'Ateliers gratuits pour aider les jeunes à se former aux outils numériques et aux métiers de demain.',
                'status' => 'pending',
            ],
            [
                'name' => 'Protection des forêts locales',
                'description' => 'Sensibilisation et actions concrètes pour freiner la déforestation dans les régions sensibles.',
                'status' => 'completed',
            ],
            [
                'name' => 'Égalité des genres en entreprise',
                'description' => 'Une campagne visant à promouvoir l’équité professionnelle entre les hommes et les femmes.',
                'status' => 'completed',
            ],
        ];

        foreach ($campaigns as $data) {
            Campaign::create(array_merge($data, [
                'user_id' => fake()->randomElement($userIds),
                'type_campaign_id' => fake()->randomElement($typeCampaignIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
