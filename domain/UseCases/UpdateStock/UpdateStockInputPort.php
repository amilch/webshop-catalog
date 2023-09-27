<?php

namespace Domain\UseCases\UpdateStock;

use Domain\Interfaces\ViewModel;

interface UpdateStockInputPort
{
    public function updateStock(UpdateStockRequestModel $request): void;
}
