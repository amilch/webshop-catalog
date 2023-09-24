<?php

namespace Domain\Catalog\Models;

use Domain\Catalog\DataTransferObjects\CategoryData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\WithData;

class Category extends Model
{
    use WithData;

    protected $dataClass =  CategoryData::class;

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
}
