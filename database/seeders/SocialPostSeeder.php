<?php

namespace Database\Seeders;

use App\Models\SocialPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Social;
use App\Models\Campaign;

class SocialPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = [
            'Découvrez nos nouvelles offres exceptionnelles de la semaine.',
            'Partagez ce post avec vos amis et tentez de gagner un cadeau.',
            'Merci à tous pour votre soutien, notre communauté grandit grâce à vous.',
            'Aujourd’hui, nous mettons en avant un de nos utilisateurs : bravo à lui.',
            'Avez-vous déjà testé notre dernière fonctionnalité ? Dites-nous en commentaire.',
            'Lundi motivation : chaque jour est une nouvelle opportunité.',
            'On répond à toutes vos questions en direct ce soir à 18h.',
            'Un grand merci à notre équipe pour ce travail remarquable.',
            'C’est le moment parfait pour démarrer votre projet avec nous.',
            'Nouvelle mise à jour disponible ! Découvrez les nouveautés maintenant.',
        ];

        foreach ($contents as $content) {
            SocialPost::factory()->create([
                'content' => $content,
                'social_id' => rand(1,3),
                'campaign_id' => Campaign::inRandomOrder()->first()->id ?? Campaign::factory(),
                'is_published' => fake()->boolean(),
            ]);
        }
    }
}
