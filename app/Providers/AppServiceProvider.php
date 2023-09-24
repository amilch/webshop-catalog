<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // UseCase: GetAllCategories
        $this->app->bind(
            \Domain\Interfaces\CategoryRepository::class,
            \App\Repositories\CategoryDatabaseRepository::class
        );

        $this->app
            ->when(\App\Http\Controllers\GetAllCategoriesController::class)
            ->needs(\Domain\UseCases\GetAllCategories\GetAllCategoriesInputPort::class)
            ->give(function ($app) {
                return $app->make(\Domain\UseCases\GetAllCategories\GetAllCategoriesInteractor::class, [
                    'output' => $app->make(\App\Adapters\Presenters\GetAllCategoriesJsonPresenter::class)
                ]);
            });

        // UseCase: CreateVariant
        $this->app->bind(
            \Domain\Interfaces\VariantFactory::class,
            \App\Factories\VariantModelFactory::class
        );

        $this->app->bind(
            \Domain\Interfaces\VariantRepository::class,
            \App\Repositories\VariantDatabaseRepository::class
        );

        $this->app
            ->when(\App\Http\Controllers\CreateVariantController::class)
            ->needs(\Domain\UseCases\CreateVariant\CreateVariantInputPort::class)
            ->give(function ($app) {
                return $app->make(\Domain\UseCases\CreateVariant\CreateVariantInteractor::class, [
                    'output' => $app->make(\App\Adapters\Presenters\CreateVariantJsonPresenter::class)
                ]);
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
