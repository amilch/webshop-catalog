<?php

namespace App\Models;

use Domain\Catalog\DataTransferObjects\CategoryData;
use Domain\Catalog\Models\Product;
use Domain\Interfaces\CategoryEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\WithData;

class Category extends Model implements CategoryEntity
{
    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'id' => 'integer'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }
}
