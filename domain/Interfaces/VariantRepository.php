<?php

namespace Domain\Interfaces;


interface VariantRepository
{
    public function upsert(VariantEntity $variant): VariantEntity;
}
