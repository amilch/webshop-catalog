<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Services\RabbitMQService;
use Bschmitt\Amqp\Facades\Amqp;
use Domain\Interfaces\Message;
use Domain\Interfaces\MessageQueueService;
use Domain\UseCases\UpdateStock\UpdateStockInputPort;
use Domain\UseCases\UpdateStock\UpdateStockInteractor;
use Domain\UseCases\UpdateStock\UpdateStockRequestModel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateStockTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_receiving_quantity_changes_in_stock(): void
    {
        $interactor = app()->make(UpdateStockInteractor::class);

        $this->assertTrue(Product::where('sku', 'basilikum_samen')->first()->getInStock());

        $interactor->updateStock(
            new UpdateStockRequestModel([
                "sku" => "basilikum_samen",
                "quantity" => 0
            ])
        );

        $this->assertFalse(Product::where('sku', 'basilikum_samen')->first()->getInStock());

        $interactor->updateStock(
            new UpdateStockRequestModel([
                "sku" => "basilikum_samen",
                "quantity" => 9
            ])
        );

        $this->assertTrue(Product::where('sku', 'basilikum_samen')->first()->getInStock());
    }
}
