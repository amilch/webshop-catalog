<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AllCategoriesResource extends JsonResource
{
    public function __construct(
        protected array $categories
    ) {}

    public function toArray($request)
    {
        return [
            'data' => $this->categories,
        ];
    }
}
