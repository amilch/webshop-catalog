<?php

namespace App\Repositories;

use App\Models\Category;
use Domain\Interfaces\CategoryRepository;

class CategoryDatabaseRepository implements CategoryRepository
{
    public function all(): array
    {
        return Category::all()->all();
    }
}
