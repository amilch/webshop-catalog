<?php

namespace Domain\Interfaces;

use Domain\ValueObjects\MoneyValueObject;

interface ProductEntity
{
    public function getCategoryId(): int;

    public function getName(): string;

    public function getSku(): string;

    public function getDescription(): ?string;

    public function getPrice(): MoneyValueObject;

    public function getWeight(): int;

}
