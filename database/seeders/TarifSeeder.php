<?php

namespace Database\Seeders;

use App\Models\Tarif;
use Illuminate\Database\Seeder;

class TarifSeeder extends Seeder
{
    public function run(): void
    {
        Tarif::updateOrCreate(
            ['name' => 'Free'],
            ['amount' => 0.00, 'max_limit' => 3]
        );

        Tarif::updateOrCreate(
            ['name' => 'Pro'],
            ['amount' => 14.99, 'max_limit' => 30]
        );
    }
}
