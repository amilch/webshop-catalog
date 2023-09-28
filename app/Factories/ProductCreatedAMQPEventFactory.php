<?php

namespace App\Factories;

use App\Events\ProductCreatedAMQPEvent;
use Domain\Events\Event;
use Domain\Events\ProductCreated\ProductCreatedEvent;
use Domain\Events\ProductCreated\ProductCreatedEventFactory;

class ProductCreatedAMQPEventFactory implements ProductCreatedEventFactory
{

    public function make(string $sku): Event
    {
        return new ProductCreatedAMQPEvent(new ProductCreatedEvent($sku));
    }
}
