<?php

namespace Domain\UseCases\GetProducts;

use Domain\Entities\Product\ProductRepository;
use Domain\Interfaces\ViewModel;

class GetProductsInteractor implements GetProductsInputPort
{
    public function __construct(
        private GetProductsOutputPort $output,
        private ProductRepository $repository,
    ) {}

    public function getProducts(GetProductsRequestModel $request): ViewModel
    {
        $products = $this->repository->all(
            id: $request->getId(),
            category_id: $request->getCategoryId(),
            sku: $request->getSku(),
        );

        return $this->output->products(
            new GetProductsResponseModel($products)
        );
    }
}
