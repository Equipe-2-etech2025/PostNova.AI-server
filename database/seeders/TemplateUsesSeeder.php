<?php

namespace Database\Seeders;

use App\Models\CampaignTemplate;
use App\Models\TemplateUse;
use App\Models\User;
use Illuminate\Database\Seeder;

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
