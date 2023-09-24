<?php

namespace Domain\Catalog\Actions;

use Domain\Catalog\DataTransferObjects\VariantData;
use Domain\Catalog\Models\Variant;

class UpsertVariantAction
{
    public static function execute(VariantData $data): Variant
    {
        $variant = Variant::updateOrCreate([
            'id' => $data->id,
        ],
        [
            ...$data->all(),
        ]);

        return $variant;
    }
}
