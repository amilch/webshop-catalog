<?php

namespace Domain\UseCases\CreateVariant;

use Domain\Interfaces\ViewModel;

interface CreateVariantOutputPort
{
    public function variantCreated(CreateVariantResponseModel $model): ViewModel;
    public function unableToCreateVariant(CreateVariantResponseModel $model, \Throwable $e): ViewModel;
}
