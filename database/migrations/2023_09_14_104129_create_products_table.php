<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible');
            $table->string('name');
            $table->integer('shipping_weight')->nullable();
            $table->integer('shipping_width')->nullable();
            $table->integer('shipping_height')->nullable();
            $table->integer('shipping_depth')->nullable();
            $table->decimal('price', 9,2);
            $table->integer('category_id');
            $table->timestamps();
            // $table->integer('sort_position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
