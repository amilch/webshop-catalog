<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVariantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function getProductId(): int
    {
        return $this->input('product_id');
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getSku(): string
    {
        return $this->input('sku');
    }

    public function getPrice(): ?string
    {
        return $this->input('price');
    }

    public function getWeight(): ?int
    {
        return $this->input('weight');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'name' => 'required|string',
            'sku' => 'required|string',
            'price' => 'string',
            'weight' => 'integer',
        ];
    }
}
