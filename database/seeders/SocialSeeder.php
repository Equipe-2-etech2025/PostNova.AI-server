<?php

namespace Database\Seeders;

use App\Models\Social;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Social::truncate();

        $socials = ['TikTok', 'X', 'LinkedIn'];

        foreach ($socials as $name) {
            Social::create(['name' => $name]);
        }
    }
}
