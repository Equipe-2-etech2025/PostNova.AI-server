<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\LandingPage;
use Illuminate\Database\Seeder;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Campaign::count() === 0) {
            Campaign::factory()->count(5)->create();
        }

        LandingPage::factory()->count(10)->create();
    }
}
