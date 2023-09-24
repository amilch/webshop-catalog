<?php

namespace Domain\Catalog\Actions;

use Domain\Catalog\DataTransferObjects\ProductData;
use Domain\Catalog\Models\Product;

class UpsertProductAction
{
    public static function execute(ProductData $data): Product
    {
        $product = Product::updateOrCreate([
            'id' => $data->id,
        ],
        [
            ...$data->all(),
        ]);

        return $product;
    }
}
