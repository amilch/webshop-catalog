<?php

namespace Domain\Catalog\Models;

use Domain\Interfaces\VariantEntity;
use Domain\ValueObjects\MoneyValueObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Variant extends Model implements HasMedia, VariantEntity
{
    use InteractsWithMedia;
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'sku',
        'price',
        'weight',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // ---------------------------------------------------------------------
    // VariantEntity methods

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getSku(): string
    {
        return $this->attributes['sku'];
    }

    public function getPrice(): ?MoneyValueObject
    {
        return $this->attributes['price'] ?
            new MoneyValueObject($this->attributes['price']) : null;
    }

    public function getWeight(): ?int
    {
        return $this->attributes['weight'] ?? null;
    }
}
