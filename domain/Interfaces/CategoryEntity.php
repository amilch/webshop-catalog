<?php

namespace Domain\Interfaces;

use Domain\ValueObjects\MoneyValueObject;

interface CategoryEntity
{
    public function getName(): string;
}
