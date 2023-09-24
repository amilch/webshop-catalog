<?php

namespace Domain\UseCases\GetProducts;

use Domain\Interfaces\ViewModel;
use Domain\UseCases\GetAllCategories\GetAllCategoriesResponseModel;

interface GetProductsOutputPort
{
    public function products(GetProductsResponseModel $model): ViewModel;
}
