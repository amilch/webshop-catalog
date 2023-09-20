<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $guarded = [];
    protected $with = ['media', 'variants'];
    protected $appends = ['price_text'];

    public function getPriceTextAttribute()
    {
        $prices = $this->variants()->get()->map(fn ($variant) => $variant->price ?? $this->default_price );
        return $prices->min() == $prices->max() ? $prices->min() . ' €' : $prices->min() . ' € -' . $prices->max() . ' €';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }

    public function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class);
    }
}
