<?php

namespace Domain\UseCases\CreateVariant;

use Domain\Interfaces\VariantFactory;
use Domain\Interfaces\VariantRepository;
use Domain\Interfaces\ViewModel;

class CreateVariantInteractor implements CreateVariantInputPort
{
    public function __construct(
        private CreateVariantOutputPort $output,
        private VariantRepository $repository,
        private VariantFactory $factory,
    ) {}

    public function createVariant(CreateVariantRequestModel $request): ViewModel
    {
        $variant = $this->factory->make([
            'product_id' => $request->getProductId(),
            'name' => $request->getName(),
            'sku' => $request->getSku(),
            'price' => $request->getPrice(),
            'weight' => $request->getWeight(),
        ]);

        try {
            $variant = $this->repository->upsert($variant);
        } catch (\Exception $e) {
            return $this->output->unableToCreateVariant(
                new CreateVariantResponseModel($variant), $e);
        }

        return $this->output->variantCreated(
            new CreateVariantResponseModel($variant)
        );
    }
}
