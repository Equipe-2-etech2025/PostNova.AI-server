<?php

namespace App\Http\Controllers\API\CampaignTemplate;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all(['name', 'icon']);
        return response()->json($categories);
    }
}
