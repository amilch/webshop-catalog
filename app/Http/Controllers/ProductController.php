<?php

namespace App\Http\Controllers;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function query(Request $request) {
        $filter_attributes = null;
        $products = QueryBuilder::for(Product::class)
            ->allowedFields(['visible', 'name'])
            ->allowedFilters([
                AllowedFilter::exact('visible'),
                AllowedFilter::partial('name'),
                AllowedFilter::exact('id'),
                AllowedFilter::exact('category', 'category_id'),
                AllowedFilter::callback('attributeValues', function(Builder $query, $attributeValueIds) {
                    $query->whereHas('attributeValues', function(Builder $query) use ($attributeValueIds) {
                        if (is_array($attributeValueIds)) {
                            $query->whereIn('attribute_value_product.attribute_value_id', $attributeValueIds);
                        } else {
                            $query->where('attribute_value_product.attribute_value_id', $attributeValueIds);
                        }
                    })->orWhereHas('variants.attributeValues', function(Builder $query) use ($attributeValueIds) {
                        if (is_array($attributeValueIds)) {
                            $query->whereIn('attribute_value_variant.attribute_value_id', $attributeValueIds);
                        } else {
                            $query->where('attribute_value_variant.attribute_value_id', $attributeValueIds);
                        }
                    });
                })
            ])
            ->allowedIncludes([]);

        $paginated_products = $products->paginate();

        $product_ids = $products->select(['id'])->get()->map(fn ($el) => $el->id)->toArray();
        $attributes = Attribute::withWhereHas('values', fn ($query) =>
            $query->whereHas('products', fn ($query) =>
                $query->whereIn('product_id', $product_ids)
            )
                ->orWhereHas('variants', fn ($query) =>
                $query->whereIn('product_id', $product_ids)
            )
        )->get();

        $filterQuery = $request->query('filter');
        if (!is_null($filterQuery) && array_key_exists('attributeValues', $filterQuery)) {
            $attributeValueIds = explode(',', $filterQuery['attributeValues']);
            $filter_attributes = Attribute::select(['id'])->withWhereHas('values', fn ($query) =>
            $query->whereIn('attribute_values.id', $attributeValueIds)
            )->get()->mapWithKeys(fn ($attribute) => [$attribute->id => $attribute->values->setVisible(['id', 'value'])]);
        }

        $custom_data = collect([
            'attributes' => $attributes,
            'filter_attributes' => $filter_attributes,
        ]);
        return response()->json($custom_data->merge($paginated_products));
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
