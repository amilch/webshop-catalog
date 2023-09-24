<?php

namespace Domain\Interfaces;


interface VariantFactory
{
    public function make(array $attributes = []): VariantEntity;
}
