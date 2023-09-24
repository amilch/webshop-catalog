<?php

namespace Domain\Catalog\DataTransferObjects;

use Spatie\LaravelData\Data;

class CategoryData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name
    ) {}

    public static function fromModel(Category $category): self
    {
        return self::from($category->toArray());
    }
}

