<?php

namespace Database\Seeders;

use App\Models\CampaignTemplate;
use App\Models\Social;
use App\Models\TemplateSocialPost;
use Illuminate\Database\Seeder;

class TemplateSocialPostSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer un template existant (par ex. le premier)
        $template = CampaignTemplate::first();

        // Récupérer ou créer quelques réseaux sociaux existants
        $tiktok = Social::firstOrCreate(['name' => 'TikTok']);
        $twitter = Social::firstOrCreate(['name' => 'X']);
        $linkedIn = Social::firstOrCreate(['name' => 'LinkedIn']);

        if ($template) {
            // TikTok : ton fun, court, accroche visuelle
            TemplateSocialPost::create([
                'content' => "🔥 Ne ratez pas notre promo flash ! 🎉\n🎵 Swipez pour découvrir l’offre avant qu’elle disparaisse ⏳",
                'social_id' => $tiktok->id,
                'template_id' => $template->id,
            ]);

            // X (Twitter) : message concis, hashtags
            TemplateSocialPost::create([
                'content' => "🚀 Offre spéciale disponible dès aujourd’hui !\n#Promo #BonPlan #Nouveauté",
                'social_id' => $twitter->id,
                'template_id' => $template->id,
            ]);

            // LinkedIn : ton plus professionnel
            TemplateSocialPost::create([
                'content' => "📢 Nous lançons une nouvelle campagne exclusive pour accompagner nos clients vers encore plus de réussite. 🚀\nDécouvrez tous les détails sur notre site",
                'social_id' => $linkedIn->id,
                'template_id' => $template->id,
            ]);
        }
    }
}
