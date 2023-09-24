<?php

namespace Domain\UseCases\GetAllCategories;

use Domain\Interfaces\ViewModel;

interface GetAllCategoriesOutputPort
{
    public function allCategories(GetAllCategoriesResponseModel $model): ViewModel;
}
