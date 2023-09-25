<?php

namespace Domain\UseCases\CreateProduct;

use Domain\Interfaces\Message;

class ProductCreatedMessageModel implements Message
{
    public function __construct(
        private array $attributes
    ) {}

    public function getSku(): string
    {
        return $this->attributes['sku'];
    }
}
