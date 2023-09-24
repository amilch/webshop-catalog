<?php

namespace App\Http\Resources;

use Domain\Interfaces\ProductEntity;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCreatedResource extends JsonResource
{
    public function __construct(
        protected ProductEntity $product
    ) {}

    public function toArray($request)
    {
        return [
            'id' => $this->product->id,
            'category_id' => $this->product->getCategoryId(),
            'name' => $this->product->getName(),
            'sku' => $this->product->getSku(),
            'description' => $this->product->getDescription(),
            'price' => $this->product->getPrice()?->toString(),
            'weight' => $this->product->getWeight(),
        ];
    }
}
