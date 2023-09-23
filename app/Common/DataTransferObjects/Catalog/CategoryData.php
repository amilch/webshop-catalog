<?php

namespace App\Common\DataTransferObjects\Catalog;

class CategoryData
{
    public function __construct(
        public readonly int $id,
        public readonly string $name
    ) {}

    public static function fromArray(array $data): self
    {
        return new static(
            $data['id'],
            $data['name'],
        );
    }
}

