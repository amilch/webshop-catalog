<?php

namespace Domain\Interfaces;


interface ProductFactory
{
    public function make(array $attributes = []): ProductEntity;
}
