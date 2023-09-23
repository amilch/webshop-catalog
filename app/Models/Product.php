<?php

namespace App\Models;

use App\Builders\ProductBuilder;
use App\Common\DataTransferObjects\Catalog\CategoryData;
use App\Common\DataTransferObjects\Catalog\ProductData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $guarded = [];
    protected $with = ['media', 'variants', 'category'];
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

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class);
    }

    public function newEloquentBuilder($query)
    {
    	return new ProductBuilder($query);
    }

    public function toData(): ProductData
    {
        return new ProductData(
            $this->id,
            $this->category->toData(),
            $this->name,
            $this->default_price,
            $this->default_weight,
            $this->description,
            $this->variants->map->toData()->toArray(),
            $this->price_text
        );
    }
}
