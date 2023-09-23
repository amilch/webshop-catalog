<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function getCategoryId(): int
    {
        return $this->input('category_id');
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getDefaultPrice(): ?string
    {
        return $this->input('default_price');
    }

    public function getDefaultWeight(): ?int
    {
        return $this->input('default_weight');
    }

    public function getDescription(): ?string
    {
        return $this->input('description');
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string',
            'default_price' => 'string',
            'default_weight' => 'integer',
            'description' => 'string',
        ];
    }
}
