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
            $table->integer('product_type_id');
            $table->integer('category_id');
            $table->boolean('visible');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->decimal('default_price', 9,2)->nullable();
            $table->integer('default_weight')->nullable();
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
