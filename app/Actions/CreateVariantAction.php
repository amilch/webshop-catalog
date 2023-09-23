<?php

namespace App\Actions;

use App\Models\Product;
use App\Models\Variant;

class CreateVariantAction
{
    public function execute(Product $product, string $name,
        string $sku, ?string $price, ?int $weight): Variant
    {
        $variant = Variant::create([
            'product_id' => $product->id,
            'name' => $name,
            'sku' => $sku,
            'price' => $price,
            'weight' => $weight,
        ]);

        return $variant;
    }
}
