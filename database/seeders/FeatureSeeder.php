<?php

namespace Database\Seeders;

use App\Models\Features;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Features::truncate();

        $feature = ['Landing Page', 'Image', 'Contenu Publicitaire'];

        foreach ($feature as $name) {
            Features::create(['name' => $name, 'created_at' => now()]);
        }
    }
}
