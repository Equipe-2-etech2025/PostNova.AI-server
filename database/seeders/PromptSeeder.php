<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prompt;
use App\Models\Campaign;

class PromptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Campaign::count() === 0) {
            Campaign::factory()->count(5)->create();
        }

        Prompt::factory()->count(10)->create();
    }
}
