<?php

namespace Domain\UseCases\CreateProduct;

use Domain\Interfaces\ViewModel;

interface CreateProductInputPort
{
    public function createProduct(CreateProductRequestModel $request): ViewModel;
}
