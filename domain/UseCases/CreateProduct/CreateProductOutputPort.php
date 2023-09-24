<?php

namespace Domain\UseCases\CreateProduct;

use Domain\Interfaces\ViewModel;

interface CreateProductOutputPort
{
    public function productCreated(CreateProductResponseModel $model): ViewModel;
    public function unableToCreateProduct(CreateProductResponseModel $model, \Throwable $e): ViewModel;
}
