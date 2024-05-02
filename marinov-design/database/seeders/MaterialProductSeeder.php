<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('material_product')->insert([
            ['material_id' => 1, 'product_id' => 1],
            ['material_id' => 1, 'product_id' => 3],
            ['material_id' => 2, 'product_id' => 1],
            ['material_id' => 2, 'product_id' => 2],
            ['material_id' => 2, 'product_id' => 3],
            ['material_id' => 2, 'product_id' => 4],
            ['material_id' => 3, 'product_id' => 1],
            ['material_id' => 3, 'product_id' => 2],
            ['material_id' => 3, 'product_id' => 3],
            ['material_id' => 3, 'product_id' => 4],
            ['material_id' => 4, 'product_id' => 1],
            ['material_id' => 4, 'product_id' => 3],
            ['material_id' => 4, 'product_id' => 4],
            ['material_id' => 5, 'product_id' => 1],
            ['material_id' => 5, 'product_id' => 2],
            ['material_id' => 5, 'product_id' => 4],
            ['material_id' => 6, 'product_id' => 1],
            ['material_id' => 6, 'product_id' => 2],
            ['material_id' => 6, 'product_id' => 3],
            ['material_id' => 6, 'product_id' => 4],
            ['material_id' => 7, 'product_id' => 1],
            ['material_id' => 7, 'product_id' => 3],
            ['material_id' => 7, 'product_id' => 4],
            ['material_id' => 8, 'product_id' => 1],
        ]);
    }
}
