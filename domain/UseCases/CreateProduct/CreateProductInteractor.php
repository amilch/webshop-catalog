<?php

namespace Domain\UseCases\CreateProduct;

use Domain\Entities\Product\ProductFactory;
use Domain\Entities\Product\ProductRepository;
use Domain\Events\EventService;
use Domain\Events\ProductCreated\ProductCreatedEvent;
use Domain\Events\ProductCreated\ProductCreatedEventFactory;
use Domain\Interfaces\ViewModel;

class CreateProductInteractor implements CreateProductInputPort
{
    public function __construct(
        private CreateProductOutputPort $output,
        private ProductRepository       $repository,
        private ProductFactory          $factory,
        private EventService            $eventService,
        private ProductCreatedEventFactory $eventFactory,
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

            $event = $this->eventFactory->make($product->getSku());
            $this->eventService->publish($event);
        } catch (\Exception $e) {
            return $this->output->unableToCreateProduct(
                new CreateProductResponseModel($product), $e);
        }

        return $this->output->productCreated(
            new CreateProductResponseModel($product)
        );
    }
}
