<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TemplateSocialPost;
use App\Models\CampaignTemplate;
use App\Models\Social;

class TemplateSocialPostSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer un template existant (par ex. le premier)
        $template = CampaignTemplate::first();

        // Récupérer quelques réseaux sociaux existants
        $facebook = Social::firstOrCreate(['name' => 'Facebook']);
        $twitter  = Social::firstOrCreate(['name' => 'Twitter']);

        if ($template) {
            TemplateSocialPost::create([
                'content' => 'Découvrez notre promo de l\'été 🌞',
                'social_id' => $facebook->id,
                'template_id' => $template->id,
            ]);

            TemplateSocialPost::create([
                'content' => 'Nouvelle offre exclusive 🚀',
                'social_id' => $twitter->id,
                'template_id' => $template->id,
            ]);

            TemplateSocialPost::create([
                'content' => 'Restez connectés pour plus de surprises 🎁',
                'social_id' => $facebook->id,
                'template_id' => $template->id,
            ]);
        }
    }
}
