<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersFavoriteProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            $data = [];
            for ($i = 1; $i <= 10; $i++) {
                $data[] = [
                    'user_id' => rand(2, 8),
                    'product_id' => rand(1, 4),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            DB::table('user_favorite_products')->insert($data);
        }
    }
}
