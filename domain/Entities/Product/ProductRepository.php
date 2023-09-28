<?php

namespace Domain\Entities\Product;


interface ProductRepository
{
    public function upsert(ProductEntity $product): ProductEntity;

    public function all(?int $id, ?int $category_id, ?array $sku): array;
}
