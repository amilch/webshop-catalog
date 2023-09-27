<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class GetCategoriesTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    public function test_returns_all_categories(): void
    {
        $response = $this->getJson('/categories');
        $response
            ->assertStatus(200)
            ->assertJsonIsArray('data')
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('data', 3, fn(AssertableJson $first) =>
                    $first->where('id', 1)
                        ->where('name', 'Gemüsesamen')
                )
            );
    }
}
