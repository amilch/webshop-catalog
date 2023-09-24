<?php

namespace Domain\UseCases\GetAllCategories;

use Domain\Interfaces\ViewModel;

interface GetAllCategoriesInputPort
{
    public function getAllCategories(): ViewModel;
}
