<?php

namespace Domain\UseCases\CreateVariant;

use Domain\Interfaces\ViewModel;

interface CreateVariantInputPort
{
    public function createVariant(CreateVariantRequestModel $request): ViewModel;
}
