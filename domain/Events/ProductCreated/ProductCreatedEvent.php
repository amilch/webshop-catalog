<?php

namespace Domain\Events\ProductCreated;

use Domain\Events\Event;

class ProductCreatedEvent implements Event
{
    public function __construct(
        private string $sku
    ){}

    public static function fromArray(array $data): self
    {
        return new self($data['sku']);
    }

    public function toArray(): array {
        return [
            'sku' => $this->sku
        ];
    }

    public function getSku(): string
    {
        return $this->sku;
    }
}
