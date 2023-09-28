<?php

namespace Domain\Entities\Category;


interface CategoryRepository
{
    public function all(): array;
}
