<?php

namespace App\Adapters\Publishers;

use App\Messages\ProductCreatedMessage;
use App\Services\RabbitMQService;
use Domain\Interfaces\Message;
use Domain\UseCases\CreateProduct\CreateProductMessageOutputPort;
use Domain\UseCases\CreateProduct\ProductCreatedMessageModel;

class ProductCreatedMessagePublisher implements CreateProductMessageOutputPort
{
    public function __construct(
        private readonly RabbitMQService $rabbitMQService
    ) {}
    public function productCreated(ProductCreatedMessageModel $model): void
    {
        $this->rabbitMQService->publish(
            new ProductCreatedMessage($model));
    }
}
