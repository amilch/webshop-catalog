<?php

namespace App\Adapters\Presenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Http\Resources\AllCategoriesResource;
use Domain\Interfaces\ViewModel;
use Domain\UseCases\GetAllCategories\GetAllCategoriesOutputPort;
use Domain\UseCases\GetAllCategories\GetAllCategoriesResponseModel;

class GetAllCategoriesJsonPresenter implements GetAllCategoriesOutputPort
{
    public function allCategories(GetAllCategoriesResponseModel $model): ViewModel
    {
        return new JsonResourceViewModel(
            new AllCategoriesResource($model->getCategories())
        );
    }
}
