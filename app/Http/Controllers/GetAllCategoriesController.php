<?php

namespace App\Http\Controllers;

use App\Adapters\ViewModels\JsonResourceViewModel;
use Domain\UseCases\GetAllCategories\GetAllCategoriesInputPort;

class GetAllCategoriesController extends Controller
{
    public function __construct(
        private GetAllCategoriesInputPort $interactor,
    ) {}

    public function __invoke()
    {
        $viewModel = $this->interactor->getAllCategories();

        if ($viewModel instanceof JsonResourceViewModel) {
            return $viewModel->getResource();
        }
    }

}
