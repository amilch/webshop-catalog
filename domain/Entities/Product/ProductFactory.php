<?php

namespace Domain\Entities\Product;


interface ProductFactory
{
    public function make(array $attributes = []): ProductEntity;
}
