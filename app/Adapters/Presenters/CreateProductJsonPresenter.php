<?php

namespace App\Adapters\Presenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Http\Resources\ProductCreatedResource;
use Domain\Interfaces\ViewModel;
use Domain\UseCases\CreateProduct\CreateProductOutputPort;
use Domain\UseCases\CreateProduct\CreateProductResponseModel;

class CreateProductJsonPresenter implements CreateProductOutputPort
{
    public function productCreated(CreateProductResponseModel $model): ViewModel
    {
        return new JsonResourceViewModel(
            new ProductCreatedResource($model->getProduct())
        );
    }

    public function unableToCreateProduct(CreateProductResponseModel $model, \Throwable $e): ViewModel
    {
        if (config('app.debug')) {
            // rethrow and let Laravel display the error
            throw $e;
        }

        return new JsonResourceViewModel(
            new UnableToCreateProductResource($e)
        );
    }
}
