<?php

namespace Domain\UseCases\GetProducts;

class GetProductsResponseModel
{
    public function __construct(private array $products) {}

    public function getProducts(): array
    {
        return $this->products;
    }
}
