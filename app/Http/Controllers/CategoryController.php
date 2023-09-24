<?php

namespace App\Http\Controllers;

use Domain\Catalog\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all()->map->getData();

        return response()->json([
            'data' => $categories
        ]);
    }

}
