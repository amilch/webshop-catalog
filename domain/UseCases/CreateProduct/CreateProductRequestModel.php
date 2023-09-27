<?php

namespace Domain\UseCases\CreateProduct;

class CreateProductRequestModel
{
    /**
     * @param array<mixed> $attributes
     */
    public function __construct(
        private array $attributes
    ) {}


    public function getCategoryId(): int
    {
        return $this->attributes['category_id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getSku(): string
    {
        return $this->attributes['sku'];
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function getDescription(): ?string
    {
        return $this->attributes['description'] ?? null;
    }
}
