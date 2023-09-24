<?php

namespace App\Http\Controllers;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Http\Requests\CreateVariantRequest;
use Domain\UseCases\CreateVariant\CreateVariantInputPort;
use Domain\UseCases\CreateVariant\CreateVariantRequestModel;

class CreateVariantController extends Controller
{
    public function __construct(
        private CreateVariantInputPort $interactor,
    ) {}

    public function __invoke(CreateVariantRequest $request)
    {
        $viewModel = $this->interactor->createVariant(
            new CreateVariantRequestModel($request->validated())
        );

        if ($viewModel instanceof JsonResourceViewModel) {
            return $viewModel->getResource();
        }
    }
}
