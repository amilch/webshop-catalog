<?php

namespace Domain\Events\ProductCreated;

use Domain\Events\Event;

interface ProductCreatedEventFactory
{
    public function make(string $sku): Event;
}
