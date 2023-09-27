<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::truncate();

        $json = File::get('database/seeders/products.json');
        $products = json_decode($json, true);

        $categories = array_map(fn ($product) => $product['category'], $products);
        $categories = array_unique($categories);

        foreach ($categories as $category)
        {
            Category::create([
                'name' => $category
            ]);
        }
    }
}
