<?php

namespace Database\Seeders;

use App\Models\CampaignTemplate;
use App\Models\TemplateTag;
use Illuminate\Database\Seeder;

class TemplateTagsSeeder extends Seeder
{
    public function run()
    {
        $templates = CampaignTemplate::all();

        foreach ($templates as $template) {
            TemplateTag::insert([
                [
                    'template_id' => $template->id,
                    'tag' => 'Marketing',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'template_id' => $template->id,
                    'tag' => 'Email',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
