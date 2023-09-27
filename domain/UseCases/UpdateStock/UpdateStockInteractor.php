<?php

namespace Domain\UseCases\UpdateStock;

use Domain\Interfaces\ProductFactory;
use Domain\Interfaces\ProductRepository;
use Domain\Interfaces\ViewModel;

class UpdateStockInteractor implements UpdateStockInputPort
{
    public function __construct(
        private ProductRepository       $repository,
    ) {}

    public function updateStock(UpdateStockRequestModel $request): void
    {
        $product = $this->repository->all(sku: [$request->getSku()])[0];

        $product->setInStock($request->getQuantity() > 0);
    }
}
