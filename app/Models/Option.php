<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Option extends Model
{
    protected $guarded = [];

    public function components(): HasMany
    {
        return $this->hasMany(Component::class);
    }
}
