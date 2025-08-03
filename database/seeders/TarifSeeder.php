<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tarif;

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
