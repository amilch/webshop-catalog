<?php

namespace App\Repositories;

use Domain\Catalog\Models\Category;
use Domain\Interfaces\CategoryRepository;

class CategoryDatabaseRepository implements CategoryRepository
{
    public function all(): array
    {
        return Category::all()->toArray();
    }
}
