<?php

namespace Domain\Catalog\ViewModels;

use Domain\Catalog\Models\Product;
use Spatie\ViewModels\ViewModel;

class ProductsWithPricesViewModel extends ViewModel
{
    public function __construct(private Product $product) {}

    public function data()
    {
        $prices = $this->product->variants()->get()->map(fn ($variant) =>
            $variant->price ?? $this->product->default_price );
        $price_text = $prices->min() == $prices->max() ?
            $prices->min() . ' €'
            : $prices->min() . ' € -' . $prices->max() . ' €';

        return [
            ...$this->product->getData()->toArray(),
            'price_text' => $price_text,
        ];
    }
}
