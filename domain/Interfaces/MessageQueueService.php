<?php

namespace Domain\Interfaces;

interface MessageQueueService
{
    public function publish(Message $msg): void;

}
