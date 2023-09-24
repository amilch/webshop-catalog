<?php

namespace App\Http\Resources;

use Domain\Interfaces\VariantEntity;
use Illuminate\Http\Resources\Json\JsonResource;

class VariantCreatedResource extends JsonResource
{
    public function __construct(
        protected VariantEntity $variant
    ) {}

    public function toArray($request)
    {
        return [
            'id' => $this->variant->id,
            'product_id' => $this->variant->getProductId(),
            'name' => $this->variant->getName(),
            'sku' => $this->variant->getSku(),
            'price' => $this->variant->getPrice(),
            'weight' => $this->variant->getWeight(),
        ];
    }
}
