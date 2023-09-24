<?php

namespace Domain\UseCases\CreateVariant;

use Domain\Interfaces\VariantEntity;

class CreateVariantResponseModel
{
    public function __construct(private VariantEntity $variant) {}

    public function getVariant(): VariantEntity
    {
        return $this->variant;
    }
}
