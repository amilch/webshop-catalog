<?php

namespace Domain\Catalog\DataTransferObjects;

use Domain\Shared\ValueObjects\Money;
use Domain\Shared\ValueObjects\MoneyCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\DataCollection;

class ProductData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly ?int $default_price,
        public readonly ?int $default_weight,
        public readonly ?string $description,
        /** @var \Domain\Catalog\DataTransferObjects\VariantData[] */
        public readonly DataCollection $variants,
        public readonly null|Lazy|CategoryData $category,
    ) {}

    public static function fromRequest(Request $request)
    {
        return self::from([
            $request->all(),
            'category' => CategoryData::from(Category::find($request->category_id)),
        ]);
    }

    public static function fromModel(Product $product): self
    {
        return self::from([
            ...$product->toArray(),
            'variants' => Lazy::whenLoaded('variants', $product, fn () =>#!/usr/bin/env php
                VariantData::collection($product->variants)),
            'category' => Lazy::whenLoaded('category', $product, fn () =>
                CategoryData::from($product->category)),
        ]);
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string',
            'default_price' => 'string',
            'default_weight' => 'integer',
            'description' => 'string',
        ];
    }
}
