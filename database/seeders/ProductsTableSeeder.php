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
        DB::table('products')->insert([
            'id' => 0,
            'category_id' => 0,
            'name' => 'Kapuzenpullover mit Reißverschluss',
            'default_price' => '29.30',
            'default_weight' => 250
        ]);

        DB::table('variants')->insert([
            'id' => 0,
            'name' => 'Größe S',
            'sku' => 'kapuzenpullover_s',
            'product_id' => 0
        ]);
    }
}
