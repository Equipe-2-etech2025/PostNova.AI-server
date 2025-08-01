<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Campaign;
use App\Models\Prompt;

class PromptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prompts = [
            'Rédige une affiche de sensibilisation à la propreté urbaine destinée aux jeunes.',
            'Crée un message de campagne encourageant les dons pour les écoles rurales.',
            'Écris un discours d’ouverture pour un atelier sur le tri des déchets.',
            'Génère un post Facebook pour promouvoir la vaccination gratuite.',
            'Formule un slogan percutant pour une campagne zéro plastique.',
            'Rédige une annonce pour le lancement d’un programme Wi-Fi gratuit pour les lycées.',
            'Écris un email adressé aux habitants pour participer à un soutien psychologique collectif.',
            'Génère une fiche informative sur les formations numériques gratuites pour les jeunes.',
            'Propose un script pour une vidéo de sensibilisation à la protection des forêts.',
            'Rédige un texte d’invitation à un événement sur l’égalité des genres en entreprise.',
        ];

        foreach ($prompts as $content) {
            Prompt::create([
                'content' => $content,
                'campaign_id' => Campaign::inRandomOrder()->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
