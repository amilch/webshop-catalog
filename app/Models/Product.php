<?php

namespace App\Models;

use Domain\Interfaces\ProductEntity;
use Domain\ValueObjects\MoneyValueObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia, ProductEntity
{
    use InteractsWithMedia;
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'description',
        'price',
        'weight',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ---------------------------------------------------------------------
    // ProductEntity methods

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getSku(): string
    {
        return $this->attributes['sku'];
    }

    public function getDescription(): ?string
    {
        return $this->attributes['description'] ?? null;
    }

    public function getPrice(): MoneyValueObject
    {
        return MoneyValueObject::fromInt($this->attributes['price']);
    }

    public function getWeight(): int
    {
        return $this->attributes['weight'];
    }
}
