<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;
use App\Models\DiscountCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $discounts = [
            ['name' => 'Промоција 1', 'percent' => 10, 'status_id' => 1],
            ['name' => 'Промоција 2', 'percent' => 15, 'status_id' => 1],
            ['name' => 'Промоција 3', 'percent' => 20, 'status_id' => 1],
            ['name' => 'Промоција 4', 'percent' => 25, 'status_id' => 1],
            ['name' => 'Промоција 5', 'percent' => 30, 'status_id' => 1],
        ];

        foreach ($discounts as $discount) {
            $discountInstance = Discount::create($discount);

            // Attach discount to random categories
            $randomCategories = DiscountCategory::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $discountInstance->discountCategories()->attach($randomCategories);
        }
    }
}
