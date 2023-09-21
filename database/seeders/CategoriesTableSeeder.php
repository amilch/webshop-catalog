<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'id' => 0,
            'name' => 'Kleidung',
        ]);
        DB::table('categories')->insert([
            'id' => 1,
            'name' => 'Mobiltelefone',
        ]);
    }
}
