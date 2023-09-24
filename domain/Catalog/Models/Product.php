<?php

namespace Domain\Catalog\Models;

use Domain\Catalog\Builder\ProductBuilder;
use Domain\Catalog\DataTransferObjects\ProductData;
use Domain\Shared\ValueObjects\MoneyCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\WithData;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    use WithData;

    protected $dataClass = ProductData::class;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'default_price',
        'default_weight'
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    protected $with = ['media', 'variants', 'category'];

    public function priceText()
    {
        $prices = $this->variants()->get()->map(fn ($variant) => $variant->price ?? $this->default_price );
        return $prices->min() == $prices->max() ? $prices->min() . ' €' : $prices->min() . ' € -' . $prices->max() . ' €';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class);
    }

    public function newEloquentBuilder($query)
    {
    	return new ProductBuilder($query);
    }
}
