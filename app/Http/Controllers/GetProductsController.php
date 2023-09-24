<?php

namespace App\Http\Controllers;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Http\Requests\GetProductsRequest;
use Domain\UseCases\GetAllCategories\GetAllCategoriesInputPort;
use Domain\UseCases\GetProducts\GetProductsInputPort;
use Domain\UseCases\GetProducts\GetProductsRequestModel;

class GetProductsController extends Controller
{
    public function __construct(
        private GetProductsInputPort $interactor,
    ) {}

    public function __invoke(GetProductsRequest $request)
    {
        $viewModel = $this->interactor->getProducts(
            new GetProductsRequestModel($request->validated()));

        if ($viewModel instanceof JsonResourceViewModel) {
            return $viewModel->getResource();
        }
    }

}
