<?php

namespace Domain\Shared\ValueObjects;

class Money
{
    public function __construct(private readonly int $value) {}

    public static function from(int $value) {
        return new static($value);
    }

    public function format(): string
    {
        return number_format($this->value / 100.0, 2);
    }
}
