<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TemplateUse;
use App\Models\CampaignTemplate;
use App\Models\User;

class TemplateUsesSeeder extends Seeder
{
    public function run()
    {
        $user = User::first() ?? User::factory()->create();

        foreach (CampaignTemplate::all() as $template) {
            TemplateUse::create([
                'template_id' => $template->id,
                'user_id' => $user->id,
                'used_at' => now(),
            ]);
        }
    }
}
