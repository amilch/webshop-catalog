<?php

namespace Domain\UseCases\CreateVariant;

class CreateVariantRequestModel
{
    /**
     * @param array<mixed> $attributes
     */
    public function __construct(
        private array $attributes
    ) {}


    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getSku(): string
    {
        return $this->attributes['sku'];
    }

    public function getPrice(): ?string
    {
        return $this->attributes['price'] ?? null;
    }

    public function getWeight(): ?int
    {
        return $this->attributes['weight'] ?? null;
    }
}
