<?php

namespace Tests\Feature;

use App\Services\RabbitMQService;
use Bschmitt\Amqp\Facades\Amqp;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    use WithoutMiddleware;

    public function test_can_create_product(): void
    {
        $this->mock(RabbitMQService::class, fn (MockInterface $mock) => $mock
            ->shouldReceive('publish')->once()
        );
        $response = $this->postJson('/products',[
            'category_id' => 1,
            'name' => 'testname',
            'sku' => 'test_sku',
            'price' => 200,
            'description'  => 'test description',
        ]);
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json
                ->has('data', fn (AssertableJson $json) => $json
                    ->where('id', 21)
                    ->where('category_id', 1)
                    ->where('name', 'testname')
                    ->where('sku', 'test_sku')
                    ->where('price', '2,00')
                    ->where('description', 'test description')
                )
            );
    }

    public function test_creating_product_publishes_event(): void
    {
        Amqp::shouldReceive('publish')
            ->once()
            ->withArgs([
                'product_created',
                '{"sku":"test_sku"}'
            ]);

        $response = $this->postJson('/products',[
            'category_id' => 1,
            'name' => 'testname',
            'sku' => 'test_sku',
            'price' => 200,
            'description'  => 'test description',
        ]);
        $response->assertStatus(200);
    }

    public function test_creating_products_with_same_sku_fails(): void
    {
        Amqp::shouldReceive('publish')->once();

        $response = $this->postJson('/products',[
            'category_id' => 1,
            'name' => 'testname',
            'sku' => 'test_sku',
            'price' => 200,
            'description'  => 'test description',
        ]);
        $response->assertStatus(200);

        $response = $this->postJson('/products',[
            'category_id' => 1,
            'name' => 'testname',
            'sku' => 'test_sku',
            'price' => 200,
            'description'  => 'test description',
        ]);
        $response->assertServerError();
    }
}
