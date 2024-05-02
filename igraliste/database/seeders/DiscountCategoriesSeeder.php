<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DiscountCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiscountCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            ['name' => 'Летен'],
            ['name' => 'Зимски'],
            ['name' => 'Пролетен'],
            ['name' => 'Есенски'],
            ['name' => 'Празничен'],
        ];

        foreach ($categories as $category) {
            DiscountCategory::create($category);
        }
    }
}
