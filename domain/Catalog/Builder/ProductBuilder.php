<?php

namespace Domain\Catalog\Builder;

use Domain\Catalog\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProductBuilder extends Builder
{
	public function search(?int $category_id = null): Collection
    {
        $query = Product::query();

        if ($category_id !== null)
        {
            $query = $query->where('category_id', $category_id);
        }

        return $query->get();
    }
}
