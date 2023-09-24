<?php

namespace Domain\UseCases\GetProducts;

use Domain\Interfaces\ViewModel;

interface GetProductsInputPort
{
    public function getProducts(GetProductsRequestModel $request): ViewModel;
}
