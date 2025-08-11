<?php

namespace Database\Seeders;

use App\Models\Tarif;
use App\Models\TarifFeature;
use Illuminate\Database\Seeder;

class TarifFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TarifFeature::truncate();

        $tarifs = Tarif::all();

        if ($tarifs->isEmpty()) {
            $tarifs = Tarif::factory()->count(1)->create();
        }

        $tarifs = $tarifs->take(1);

        $features = [
            'Landing pages illimitées',
            'Templates premium',
            'Image illimitées',
            'Campaign illimitées',
            'Générateur IA avancé',
            'Analytics avancées',
            'Support prioritaire',
            'Intégrations CRM',
        ];

        foreach ($tarifs as $tarif) {
            foreach ($features as $featureName) {
                TarifFeature::create([
                    'tarif_id' => rand(1, 2),
                    'name' => $featureName,
                ]);
            }
        }
    }
}
