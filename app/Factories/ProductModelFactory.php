<?php

namespace App\Factories;

use App\Models\Category;
use App\Models\Product;
use Domain\Interfaces\ProductEntity;
use Domain\Interfaces\ProductFactory;

class ProductModelFactory implements ProductFactory
{
    public function make(array $attributes = []): ProductEntity
    {
        $product = new Product($attributes);
        $product->category()->associate(
            Category::findOrFail($attributes['category_id']));

        return $product;
    }
}
