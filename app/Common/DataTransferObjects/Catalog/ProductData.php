<?php

namespace App\Common\DataTransferObjects\Catalog;

class ProductData
{
    public function __construct(
        public readonly int $id,
        public readonly CategoryData $category,
        public readonly string $name,
        public readonly ?string $default_price,
        public readonly ?int $default_weight,
        public readonly ?string $description,
        public readonly array $variants,
        public readonly string $price_text
    ) {}

    public static function fromArray(array $data): self
    {
        return new static(
            $data['id'],
            CategoryData::fromArray($data['category']),
            $data['name'],
            $data['default_price'],
            $data['default_weight'],
            $data['description'],
            array_map(fn ($variant) => VariantData::fromArray($variant),
                $data['variants']),
            $data['price_text']
        );
    }
}
