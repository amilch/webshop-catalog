<?php

namespace App\Http\Controllers;

use App\Actions\CreateProductAction;
use App\Http\Requests\GetProductsRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;

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
        return response()->json([
            'data' => $product->toData()
        ]);
    }

    public function store(StoreProductRequest $request,
        CreateProductAction $createProduct)
    {
        $product = $createProduct->execute(
            Category::find($request->getCategoryId()),
            $request->getName(),
            $request->getDefaultPrice(),
            $request->getDefaultWeight(),
            $request->getDescription()
        );

        return response()->json([
            'data' => $product->toData()
        ], Response::HTTP_CREATED);
    }
}
