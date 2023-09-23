<?php

namespace App\Actions;

use App\Models\Category;
use App\Models\Product;

class CreateProductAction
{
    public function execute(Category $category, string $name,
        ?string $default_price, ?int $default_weight, ?string $description): Product
    {
        $product = Product::create([
            'category_id' => $category->id,
            'name' => $name,
            'default_price' => $default_price,
            'default_weight' => $default_weight,
            'description' => $description,
        ]);

        return $product;
    }
}
