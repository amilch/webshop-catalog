<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class GetProductsTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    public function test_returns_all_products(): void
    {
        $response = $this->getJson('/products');
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('data', 20, fn(AssertableJson $json) =>
                    $json->where('id', 1)
                        ->where('name', 'Kirsch-Tomaten Samen')
                        ->where('category_id', 1)
                        ->where('sku', 'kirsch_tomaten_samen')
                        ->where('price', '2,49')
                        ->where('description', fn ($desc) => strlen($desc) > 10)
                        ->where('in_stock', true)
                )
            );
    }

    public function test_returns_products_by_id(): void
    {
        $response = $this->getJson('/products?id=1');
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('data', 1, fn(AssertableJson $json) => $json
                ->where('id', 1)
                ->etc()
            )
        );
    }

    public function test_returns_products_by_sku(): void
    {
        $response = $this->getJson('/products?sku=kirsch_tomaten_samen');
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('data', 1, fn(AssertableJson $json) => $json
                ->where('sku', 'kirsch_tomaten_samen')
                ->etc()
            )
        );
    }

    public function test_returns_products_by_sku_list(): void
    {
        $skus = ['kirsch_tomaten_samen', 'basilikum_samen'];
        $response = $this->getJson('/products?sku=' . join(',', $skus));
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('data', 2, fn(AssertableJson $json) => $json
                ->where('sku', fn ($sku) => in_array($sku, $skus))
                ->etc()
            )
        );
    }

    public function test_returns_products_by_category(): void
    {
        $response = $this->getJson('/products?category_id=2');
        $response
            ->assertStatus(200)
            ->assertJsonIsArray('data')
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('data', 1, fn(AssertableJson $json) => $json
                ->where('category_id', 2)
                ->etc()
            )
        );
    }

    public function test_returns_empty_when_no_products_found(): void
    {
        $response = $this->getJson('/products?category_id=999');
        $response
            ->assertStatus(200)
            ->assertJsonIsArray('data')
            ->assertJson(fn (AssertableJson $json) => $json
                ->has('data', 0)
            );
    }
}
