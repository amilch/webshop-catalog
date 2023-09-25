<?php

namespace App\Messages;

use Domain\Interfaces\Message;

interface RabbitMQMessage extends Message
{
    public function getRoutingKey(): string;

    public function toArray(): array;

}
