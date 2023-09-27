<?php

namespace Domain\UseCases\CreateProduct;

use Domain\Interfaces\ProductFactory;
use Domain\Interfaces\ProductRepository;
use Domain\Interfaces\ViewModel;

class CreateProductInteractor implements CreateProductInputPort
{
    public function __construct(
        private CreateProductOutputPort $output,
        private CreateProductMessageOutputPort $messageOutput,
        private ProductRepository       $repository,
        private ProductFactory          $factory,
    ) {}

    public function createProduct(CreateProductRequestModel $request): ViewModel
    {
        $product = $this->factory->make([
            'category_id' => $request->getCategoryId(),
            'name' => $request->getName(),
            'sku' => $request->getSku(),
            'description' => $request->getDescription(),
            'price' => $request->getPrice(),
            'in_stock' => false,
        ]);

        try {
            $product = $this->repository->upsert($product);

            $message = new ProductCreatedMessageModel([
                'sku' => $product->getSku()
            ]);
            $this->messageOutput->productCreated($message);
        } catch (\Exception $e) {
            return $this->output->unableToCreateProduct(
                new CreateProductResponseModel($product), $e);
        }

        return $this->output->productCreated(
            new CreateProductResponseModel($product)
        );
    }
}
