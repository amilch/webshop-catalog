<?php

namespace App\Events;

use Domain\Events\ProductCreated\ProductCreatedEvent;

class ProductCreatedAMQPEvent implements AMQPEvent
{
    public function __construct(
        private ProductCreatedEvent $event
    ) {}

    public function getRoutingKey(): string
    {
        return "product_created";
    }

    public function toArray(): array
    {
        return $this->event->toArray();
    }

    public static function fromArray(array $data): self
    {
        return new self(ProductCreatedEvent::fromArray($data));
    }
}
