<?php

namespace Database\Seeders;

use App\Models\CampaignTemplate;
use App\Models\Category;
use App\Models\TypeCampaign;
use Illuminate\Database\Seeder;

class CampaignTemplatesSeeder extends Seeder
{
    public function run()
    {
        // Assurer qu'il existe au moins 1 type_campaign
        $typeCampaign = TypeCampaign::first() ?? TypeCampaign::create([
            'name' => 'Marketing Email',
            'description' => 'Campagne marketing par e-mail',
        ]);

        // Assurer qu'il existe les catégories nécessaires
        $salesCategory = Category::firstOrCreate(['name' => 'sales'], ['icon' => 'BsShop']);
        $launchCategory = Category::firstOrCreate(['name' => 'launch'], ['icon' => 'BsRocket']);

        CampaignTemplate::insert([
            [
                'name' => 'Campagne Black Friday',
                'description' => 'Modèle optimisé pour les ventes flash et promotions limitées.',
                'category_id' => $salesCategory->id,
                'type_campaign_id' => $typeCampaign->id,
                'author' => 'John Doe',
                'thumbnail' => 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=400&h=200&fit=crop',
                'preview' => '🔥 BLACK FRIDAY : -70% sur TOUT ! Dernières heures pour profiter de nos prix exceptionnels...',
                'is_premium' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lancement de Produit',
                'description' => 'Template parfait pour annoncer un nouveau produit ou service.',
                'category_id' => $launchCategory->id,
                'type_campaign_id' => $typeCampaign->id,
                'author' => 'Jane Smith',
                'thumbnail' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=400&h=200&fit=crop',
                'preview' => '✨ Découvrez notre dernière innovation ! Après des mois de développement, nous sommes fiers de...',
                'is_premium' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
