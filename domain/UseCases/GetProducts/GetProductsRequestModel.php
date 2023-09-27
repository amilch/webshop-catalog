<?php

namespace Domain\UseCases\GetProducts;

class GetProductsRequestModel
{
    /**
     * @param array<mixed> $attributes
     */
    public function __construct(
        private array $attributes
    ) {}


    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }

    public function getCategoryId(): ?int
    {
        return $this->attributes['category_id'] ?? null;
    }

    public function getSku(): ?array
    {
        $sku = $this->attributes['sku'] ?? null;
        return $sku != null ? explode(',', $sku) : null;
    }

}
