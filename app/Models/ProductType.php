<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductType extends Model
{
    protected $guarded = [];

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class);
    }
}
