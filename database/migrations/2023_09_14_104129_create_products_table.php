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
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('cascade');
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->integer('price');
            $table->boolean('in_stock');
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
