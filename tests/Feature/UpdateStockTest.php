<?php

namespace Tests\Feature;

use App\Models\Product;
use Domain\UseCases\UpdateStock\UpdateStockInteractor;
use Domain\UseCases\UpdateStock\UpdateStockRequestModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
