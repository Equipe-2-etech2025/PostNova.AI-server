<?php

namespace Database\Seeders;

use App\Models\CampaignInteraction;
use Illuminate\Database\Seeder;

class CampaignInteractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CampaignInteraction::factory()->count(50)->create();
    }
}
