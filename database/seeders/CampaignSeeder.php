<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
//        if (User::count() === 0) {
//            User::factory()->count(5)->create();
//        }

//        if (TypeCampaign::count() === 0) {
//            $types = [
//                'Lancement produit',
//                'Notoriété de marque',
//                'Génération de leads',
//                'Promotion des ventes',
//                'Promotion d’événement',
//                'Leadership d’opinion',
//            ];
//
//            foreach ($types as $type) {
//                TypeCampaign::create(['name' => $type]);
//            }
//        }

        Campaign::factory()->count(10)->create();
    }
}
