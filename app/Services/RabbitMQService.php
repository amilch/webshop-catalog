<?php

namespace App\Services;

use App\Messages\RabbitMQMessage;
use Bschmitt\Amqp\Facades\Amqp;
use Domain\Interfaces\Message;
use Domain\Interfaces\MessageQueueService;

class RabbitMQService implements MessageQueueService
{
    public function publish(Message $msg): void
    {
        if ($msg instanceof RabbitMQMessage) {
            $encodedMessage = json_encode($msg->toArray());
            Amqp::publish($msg->getRoutingKey(), $encodedMessage);
        }
    }
}
