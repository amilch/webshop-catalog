<?php

namespace App\Messages;

use Domain\UseCases\CreateProduct\ProductCreatedMessageModel;

class ProductCreatedMessage implements RabbitMQMessage
{
    public function __construct(
        private ProductCreatedMessageModel $message
    ) {}

    public function getRoutingKey(): string
    {
        return "product_created";
    }

    public function toArray(): array
    {
        return [
            'sku' => $this->message->getSku(),
        ];
    }
}
