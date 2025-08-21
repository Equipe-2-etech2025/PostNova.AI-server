<?php

namespace Database\Seeders;

use App\Models\CampaignTemplate;
use App\Models\TemplateRating;
use App\Models\User;
use Illuminate\Database\Seeder;

class TemplateRatingsSeeder extends Seeder
{
    public function run()
    {
        // On suppose que tu as déjà des utilisateurs
        $user = User::first() ?? User::factory()->create();

        foreach (CampaignTemplate::all() as $template) {
            TemplateRating::create([
                'template_id' => $template->id,
                'user_id' => $user->id,
                'rating' => 4.5,
            ]);
        }
    }
}
