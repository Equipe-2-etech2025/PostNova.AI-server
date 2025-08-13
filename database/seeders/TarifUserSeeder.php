<?php

namespace Database\Seeders;

use App\Models\Tarif;
use App\Models\TarifUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class TarifUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TarifUser::truncate();

        $tarifs = Tarif::count() ? Tarif::all() : Tarif::factory()->count(3)->create();
        $users = User::count() ? User::all() : User::factory()->count(10)->create();

        TarifUser::factory()->count(10)->create();
    }
}
