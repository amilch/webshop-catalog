<?php

namespace Domain\ValueObjects;

class MoneyValueObject
{
    private int $value;

    public function __construct(string $value)
    {
       $split = explode('.', $value);
       $this->value = $split[0] * 100  +  $split[1];
    }

    public function __toString()
    {
        return number_format($this->value / 100.0, 2);
    }

    public function isEqualTo(self $other): bool
    {
        return $this->value === $other->value;
    }
}
