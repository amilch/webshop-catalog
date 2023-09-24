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
            'sku' => 'kapuzenpullover',
            'price' => 2930,
            'weight' => 250
        ]);
    }
}
