<?php

namespace Domain\Interfaces;

use Domain\ValueObjects\MoneyValueObject;

interface VariantEntity
{
    //TODO: replace with ProductEntity
    public function getProductId(): int;

    public function getName(): string;

    public function getSku(): string;

    public function getPrice(): ?MoneyValueObject;

    public function getWeight(): ?int;

}
