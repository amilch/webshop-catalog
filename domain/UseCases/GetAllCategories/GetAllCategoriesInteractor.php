<?php

namespace Domain\UseCases\GetAllCategories;

use Domain\Entities\Category\CategoryRepository;
use Domain\Interfaces\ViewModel;

class GetAllCategoriesInteractor implements GetAllCategoriesInputPort
{
    public function __construct(
        private GetAllCategoriesOutputPort $output,
        private CategoryRepository $repository,
    ) {}

    public function getAllCategories(): ViewModel
    {
        $categories = $this->repository->all();

        return $this->output->allCategories(
            new GetAllCategoriesResponseModel($categories)
        );
    }
}
