<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Domain\ValueObjects\MoneyValueObject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::truncate();

        $json = File::get('database/seeders/products.json');
        $products = json_decode($json, true);

        $categories = array_map(fn ($product) => $product['category'], $products);
        $categories = array_unique($categories);

        foreach ($products as $product)
        {
            $category = Category::where('name', $product['category'])->first();
            $category->products()->create([
                'name' => $product['name'],
                'sku' => $product['sku'],
                'price' => MoneyValueObject::fromString($product['price'])->toInt(),
                'description' => $product['description'],
                'in_stock' => $product['in_stock'],
            ]);
        }
    }
}
