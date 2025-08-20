<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'vente', 'icon' => 'BsShop'],
            ['name' => 'sales', 'icon' => 'BsShop'],
            ['name' => 'lancement', 'icon' => 'BsRocket'],
            ['name' => 'launch', 'icon' => 'BsRocket'],
            ['name' => 'visibilité', 'icon' => 'BsRocket'],
            ['name' => 'visibility', 'icon' => 'BsRocket'],
            ['name' => 'engagement', 'icon' => 'BsPeople'],
            ['name' => 'image de marque', 'icon' => 'BsBullseye'],
            ['name' => 'branding', 'icon' => 'BsBullseye'],
            ['name' => 'promotion', 'icon' => 'BsMegaphone'],
            ['name' => 'marketing', 'icon' => 'BsMegaphone'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['name' => $cat['name']], $cat);
        }
    }
}
