<?php

namespace App\Http\Controllers;

use App\Actions\CreateVariantAction;
use App\Http\Requests\StoreVariantRequest;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;

class VariantController extends Controller
{
    public function store(StoreVariantRequest $request,
        CreateVariantAction $createVariant)
    {
        $variant = $createVariant->execute(
            Product::find($request->getProductId()),
            $request->getName(),
            $request->getSku(),
            $request->getPrice(),
            $request->getWeight()
        );

        return response()->json([
            'data' => $variant->toData()
        ], Response::HTTP_CREATED);
    }
}
