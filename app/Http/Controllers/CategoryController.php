<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    public function query()
    {
        $categories = QueryBuilder::for(Category::class)
            ->allowedFilters([AllowedFilter::exact('id')])
            ->allowedIncludes(['products'])
            ->get();
        return response()->json($categories);
    }

}
