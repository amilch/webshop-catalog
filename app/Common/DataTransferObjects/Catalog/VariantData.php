<?php

namespace App\Common\DataTransferObjects\Catalog;

class VariantData
{
    public function __construct(
        public readonly int $id,
        public readonly int $product_id,
        public readonly string $name,
        public readonly string $sku,
        public readonly ?string $price,
        public readonly ?int $weight
    ) {}

    public static function fromArray(array $data): self
    {
        return new static(
            $data['id'],
            $data['product_id'],
            $data['name'],
            $data['sku'],
            $data['price'],
            $data['weight']
        );
    }
}
