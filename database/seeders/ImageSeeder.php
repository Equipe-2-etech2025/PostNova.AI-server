<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Campaign::count() === 0) {
            Campaign::factory()->count(3)->create();
        }

        Image::factory()->count(10)->create();
    }
}
