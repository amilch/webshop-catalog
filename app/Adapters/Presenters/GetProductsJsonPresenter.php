<?php

namespace App\Adapters\Presenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Http\Resources\AllCategoriesResource;
use App\Http\Resources\ProductsResource;
use Domain\Interfaces\ViewModel;
use Domain\UseCases\GetAllCategories\GetAllCategoriesOutputPort;
use Domain\UseCases\GetAllCategories\GetAllCategoriesResponseModel;
use Domain\UseCases\GetProducts\GetProductsOutputPort;
use Domain\UseCases\GetProducts\GetProductsResponseModel;

class GetProductsJsonPresenter implements GetProductsOutputPort
{
    public function products(GetProductsResponseModel $model): ViewModel
    {
        return new JsonResourceViewModel(
            new ProductsResource($model->getProducts())
        );
    }
}
