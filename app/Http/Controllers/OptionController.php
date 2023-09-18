<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OptionController extends Controller
{
    public function query()
    {
        $query = Option::with('components');
        $options = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::callback('category', function(Builder $query, $category) {
                    $query->whereHas('components.products.category', function(Builder $query) use ($category) {
                        $query->where('id', $category);
                    });
                })
            ])
            ->get();
        return response()->json($options);
    }
}
