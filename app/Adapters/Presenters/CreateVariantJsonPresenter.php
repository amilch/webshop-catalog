<?php

namespace App\Adapters\Presenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Http\Resources\VariantCreatedResource;
use Domain\Interfaces\ViewModel;
use Domain\UseCases\CreateVariant\CreateVariantOutputPort;
use Domain\UseCases\CreateVariant\CreateVariantResponseModel;

class CreateVariantJsonPresenter implements CreateVariantOutputPort
{
    public function variantCreated(CreateVariantResponseModel $model): ViewModel
    {
        return new JsonResourceViewModel(
            new VariantCreatedResource($model->getVariant())
        );
    }

    public function unableToCreateVariant(CreateVariantResponseModel $model, \Throwable $e): ViewModel
    {
        if (config('app.debug')) {
            // rethrow and let Laravel display the error
            throw $e;
        }

        return new JsonResourceViewModel(
            new UnableToCreateVariantResource($e)
        );
    }
}
