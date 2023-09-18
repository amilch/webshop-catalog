<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'id' => 0,
            'name' => 'Pullover',
        ]);
        DB::table('products')->insert([
            'id' => 0,
            'name' => 'Kapuzenpullover mit Reißverschluss',
            'visible' => true,
            'price' => '29.30',
            'category_id' => 0,
        ]);
        DB::table('options')->insert([
            'id' => 0,
            'name' => 'Größe',
        ]);
        DB::table('components')->insert(['id' => 0, 'name' => 'S', 'option_id' => 0]);
        DB::table('components')->insert(['id' => 1, 'name' => 'M', 'option_id' => 0]);
        DB::table('components')->insert(['id' => 2, 'name' => 'L', 'option_id' => 0]);
        DB::table('components')->insert(['id' => 3, 'name' => 'XL', 'option_id' => 0]);
        DB::table('components')->insert(['id' => 4, 'name' => 'XXL', 'option_id' => 0]);
        DB::table('components')->insert(['id' => 5, 'name' => 'XXXL', 'option_id' => 0]);
        DB::table('components')->insert(['id' => 6, 'name' => '4XL', 'option_id' => 0]);
        DB::table('component_product')->insert(['component_id' => 0, 'product_id' => 0]);
        DB::table('component_product')->insert(['component_id' => 1, 'product_id' => 0]);
        DB::table('component_product')->insert(['component_id' => 2, 'product_id' => 0]);
        DB::table('component_product')->insert(['component_id' => 3, 'product_id' => 0]);
        DB::table('component_product')->insert(['component_id' => 4, 'product_id' => 0]);
        DB::table('component_product')->insert(['component_id' => 5, 'product_id' => 0]);
        DB::table('component_product')->insert(['component_id' => 6, 'product_id' => 0]);

        DB::table('options')->insert([ 'id' => 1, 'name' => 'Farbe', ]);
        DB::table('components')->insert(['id' => 7, 'name' => 'Schwarz', 'option_id' => 1]);
        DB::table('components')->insert(['id' => 8, 'name' => 'Rot', 'option_id' => 1]);
    }
}
