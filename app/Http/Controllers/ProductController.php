<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function query() {
        $products = QueryBuilder::for(Product::class)
            ->allowedFields(['visible', 'name'])
            ->allowedFilters([
                AllowedFilter::exact('visible'),
                AllowedFilter::partial('name'),
                AllowedFilter::exact('id'),
                AllowedFilter::exact('category', 'category_id')
            ])
            ->allowedIncludes([])
            ->paginate();

        return response()->json($products);
    }
}
