<?php

namespace Database\Seeders;

use App\Models\TypeCampaign;
use Illuminate\Database\Seeder;

class TypeCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeCampaign::truncate();

        $types = [
            'Lancement produit',
            'Notoriété de marque',
            'Génération de leads',
            'Promotion des ventes',
            'Promotion d’événement',
            'Leadership d’opinion',
        ];

        foreach ($types as $type) {
            TypeCampaign::create(['name' => $type]);
        }
    }
}
