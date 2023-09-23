<?php

namespace App\Models;

use App\Common\DataTransferObjects\Catalog\VariantData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Variant extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function toData(): VariantData
    {
        return new VariantData(
            $this->id,
            $this->product->id,
            $this->name,
            $this->sku,
            $this->price,
            $this->weight
        );
    }
}
