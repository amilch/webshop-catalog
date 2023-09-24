<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetProductsRequest;
use Domain\Catalog\Actions\UpsertProductAction;
use Domain\Catalog\DataTransferObjects\ProductData;
use Domain\Catalog\Models\Product;
use Domain\Catalog\ViewModels\ProductViewModel;

class ProductController extends Controller
{
    public function index(GetProductsRequest $request)
    {
        $products = Product::search(category_id: $request->getCategoryId());

        return response()->json([
            'data' => $products->map->toData(),
        ]);
    }

    public function get(Product $product)
    {
        $view = new ProductViewModel($product);
        return response()->json([
            'data' => $view->toArray(),
        ]);
    }

    public function store(ProductData $data)
    {
        $product = UpsertProductAction::execute($data);

        return $product->getData();
    }
}
