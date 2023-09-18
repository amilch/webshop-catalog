<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function query() {
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                AllowedFilter::exact('visible'),
                AllowedFilter::partial('name'),
                AllowedFilter::exact('id'),
                AllowedFilter::exact('category', 'category_id'),
                AllowedFilter::callback('component', function(Builder $query, $components) {
                    $query->whereHas('components', function(Builder $query) use ($components) {
                        if (is_array($components)) {
                            $query->whereIn('components.id', $components);
                        } else {
                            $query->where('components.id', $components);
                        }
                    });
                })
            ])
            ->allowedIncludes(['category','components.option'])
            ->paginate();
        return response()->json($products);
    }

    public function create(Request $req) {
        $product = new Product();

        $product->visible = $req->visible;
        $product->name = $req->name;
        $product->shipping_weight = $req->shipping_weight;
        $product->shipping_width = $req->shipping_width;
        $product->shipping_height = $req->shipping_height;
        $product->shipping_depth = $req->shipping_depth;
        $product->price = $req->price;
        $product->category_id = $req->category_id;
        $product->sort_position = $req->sort_position;

        $product->save();
        return response()->json($product);
    }
}
