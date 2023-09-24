<?php

namespace Domain\Shared\ValueObjects;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class MoneyCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        return $value / 100.0;
    }

    public function set($model, $key, $value, $attributes)
    {
        return $value * 100.0;
    }
}
