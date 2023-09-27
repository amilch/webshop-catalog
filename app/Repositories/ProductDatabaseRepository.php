<?php

namespace App\Repositories;

use App\Models\Product;
use Domain\Interfaces\ProductEntity;
use Domain\Interfaces\ProductRepository;

class ProductDatabaseRepository implements ProductRepository
{
    public function upsert(ProductEntity $product): ProductEntity
    {
        return Product::updateOrCreate([
            'id' => $product->id,
        ],
        [
            'category_id' => $product->getCategoryId(),
            'name' => $product->getName(),
            'sku' => $product->getSku(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice()->toInt(),
            'weight' => $product->getWeight(),
        ]);
    }

    public function all(?int $id = null, ?int $category_id = null, ?array $sku = null): array
    {
        $builder = Product::query();

        if ($id !== null)
        {
            $builder = $builder->where('id', $id);
        }

        if ($category_id !== null)
        {
            $builder = $builder->where('category_id', $category_id);
        }

        if ($sku !== null)
        {
            $builder = $builder->whereIn('sku', $sku);
        }

        return $builder->get()->all();
    }
}
