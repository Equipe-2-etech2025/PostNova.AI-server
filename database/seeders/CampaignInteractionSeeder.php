<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CampaignInteraction;

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