<?php

namespace Domain\UseCases\CreateProduct;

use Domain\Interfaces\Message;

interface CreateProductMessageOutputPort
{
    public function productCreated(ProductCreatedMessageModel $model): void;
}
