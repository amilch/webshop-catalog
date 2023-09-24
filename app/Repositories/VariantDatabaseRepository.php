<?php

namespace App\Repositories;

use Domain\Catalog\Models\Variant;
use Domain\Interfaces\VariantEntity;
use Domain\Interfaces\VariantRepository;

class VariantDatabaseRepository implements VariantRepository
{
    public function upsert(VariantEntity $variant): VariantEntity
    {
        return Variant::updateOrCreate([
            'id' => $variant->id,
        ],
        [
            'product_id' => $variant->getProductId(),
            'name' => $variant->getName(),
            'sku' => $variant->getSku(),
            'price' => $variant->getPrice(),
            'weight' => $variant->getWeight(),
        ]);
    }
}
