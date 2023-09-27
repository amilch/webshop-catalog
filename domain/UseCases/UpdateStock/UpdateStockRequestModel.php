<?php

namespace Domain\UseCases\UpdateStock;

class UpdateStockRequestModel
{
    /**
     * @param array<mixed> $attributes
     */
    public function __construct(
        private array $attributes
    ) {}

    public function getSku(): string
    {
        return $this->attributes['sku'];
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }
}
