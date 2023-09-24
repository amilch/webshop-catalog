<?php

namespace Domain\UseCases\GetAllCategories;

class GetAllCategoriesResponseModel
{
    public function __construct(private array $categories) {}

    public function getCategories(): array
    {
        return $this->categories;
    }
}
