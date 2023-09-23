<?php

namespace App\Models;

use App\Common\DataTransferObjects\Catalog\CategoryData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $guarded = [];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function toData(): CategoryData
    {
        return new CategoryData(
            $this->id,
            $this->name
        );
    }
}
