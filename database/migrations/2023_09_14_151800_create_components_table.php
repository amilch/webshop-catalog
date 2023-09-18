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
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price_change', 9, 2)->nullable();
            $table->boolean('default')->default(false);
            $table->integer('option_id');
            // $table->integer('sort_position');
            $table->integer('shipping_weight')->nullable();
            $table->integer('shipping_width')->nullable();
            $table->integer('shipping_height')->nullable();
            $table->integer('shipping_depth')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
