<?php

namespace App\Http\Controllers;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Http\Requests\CreateProductRequest;
use Domain\UseCases\CreateProduct\CreateProductInputPort;
use Domain\UseCases\CreateProduct\CreateProductRequestModel;

class CreateProductController extends Controller
{
    public function __construct(
        private CreateProductInputPort $interactor,
    ) {}

    public function __invoke(CreateProductRequest $request)
    {
        $viewModel = $this->interactor->createProduct(
            new CreateProductRequestModel($request->validated())
        );

        if ($viewModel instanceof JsonResourceViewModel) {
            return $viewModel->getResource();
        }
    }
}
