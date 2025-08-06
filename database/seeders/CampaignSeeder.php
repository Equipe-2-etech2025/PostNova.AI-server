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
        $userIds = User::pluck('id')->toArray();

        $typeCampaignIds = TypeCampaign::pluck('id')->toArray();

        $campaigns = [
            [
                'name' => 'Campagne pour la propreté urbaine',
                'description' => 'Cette campagne vise à sensibiliser les citoyens à l’importance de maintenir la propreté dans les rues de la ville.',
                'status' => 1,
            ],
            [
                'name' => 'Collecte de fonds pour les écoles rurales',
                'description' => 'Objectif : améliorer les conditions d’apprentissage dans les zones défavorisées.',
                'status' => 2,
            ],
            [
                'name' => 'Sensibilisation au tri des déchets',
                'description' => 'Une campagne éducative pour initier les habitants au tri sélectif et au recyclage.',
                'status' => 3,
            ],
            [
                'name' => 'Campagne de vaccination pour tous',
                'description' => 'Une initiative visant à assurer une couverture vaccinale complète dans les zones rurales et urbaines.',
                'status' => 4,
            ],
            [
                'name' => 'Campagne zéro plastique',
                'description' => 'Cette campagne encourage l’abandon des plastiques à usage unique au profit de solutions durables.',
                'status' => 5,
            ],
            [
                'name' => 'Accès à Internet pour les jeunes',
                'description' => 'Promotion de l’inclusion numérique à travers l’installation de bornes Wi-Fi gratuites dans les écoles publiques.',
                'status' => 1,
            ],
            [
                'name' => 'Soutien psychologique post-COVID',
                'description' => 'Des séances de soutien et d’écoute pour les personnes affectées émotionnellement par la pandémie.',
                'status' => 2,
            ],
            [
                'name' => 'Formation en compétences numériques',
                'description' => 'Ateliers gratuits pour aider les jeunes à se former aux outils numériques et aux métiers de demain.',
                'status' => 3,
            ],
            [
                'name' => 'Protection des forêts locales',
                'description' => 'Sensibilisation et actions concrètes pour freiner la déforestation dans les régions sensibles.',
                'status' => 4,
            ],
            [
                'name' => 'Égalité des genres en entreprise',
                'description' => 'Une campagne visant à promouvoir l’équité professionnelle entre les hommes et les femmes.',
                'status' => 5,
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
