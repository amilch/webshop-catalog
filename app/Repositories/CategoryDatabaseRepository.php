<?php

namespace App\Repositories;

use App\Models\Category;
use Domain\Entities\Category\CategoryRepository;

class CategoryDatabaseRepository implements CategoryRepository
{
    public function all(): array
    {
        return Category::all()->all();
    }
}
