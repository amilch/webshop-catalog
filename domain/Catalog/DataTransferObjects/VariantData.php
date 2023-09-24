<?php

namespace Domain\Catalog\DataTransferObjects;

use Domain\Shared\ValueObjects\Money;
use Spatie\LaravelData\Data;

class VariantData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $product_id,
        public readonly string $name,
        public readonly string $sku,
        public readonly ?Money $price,
        public readonly ?int $weight
    ) {}

    // public static function fromRequest(Request $request)
    // {
    //     return self::from([
    //         $request->all(),
    //     ]);
    // }

    // public static function fromModel(Variant $variant): self
    // {
    //     return self::from([
    //         ...$variant->toArray()
    //     ]);
    // }

    // public static function rules(): array
    // {
    //     return [
    //         'product_id' => 'required|integer|exists:products,id',
    //         'name' => 'required|string',
    //         'sku' => 'required|string',
    //         'price' => 'string',
    //         'weight' => 'integer',
    //     ];
    // }
}
