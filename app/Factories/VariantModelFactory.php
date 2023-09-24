<?php

namespace App\Factories;

use Domain\Catalog\Models\Product;
use Domain\Catalog\Models\Variant;
use Domain\Interfaces\VariantEntity;
use Domain\Interfaces\VariantFactory;
use Domain\ValueObjects\MoneyValueObject;

class VariantModelFactory implements VariantFactory
{
    public function make(array $attributes = []): VariantEntity
    {
        if (isset($attributes['price']) && is_string($attributes['price']))
        {
            $attributes['price'] = new MoneyValueObject($attributes['price']);
        }

        $variant = new Variant($attributes);
        $variant->product()->associate(
            Product::findOrFail($attributes['product_id']));
        return $variant;
    }
}
