<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $brands = [
            [
                'name' => 'UrbanTrend',
                'description' => 'Modern styles for the urban adventurer.',
                'status_id' => 1,
            ],
            [
                'name' => 'VintageLove',
                'description' => 'Classic fashion for the nostalgic soul.',
                'status_id' => 1,
            ],
            [
                'name' => 'EcoWear',
                'description' => 'Eco-friendly clothing for the conscious consumer.',
                'status_id' => 1,
            ],
            [
                'name' => 'GlamGlow',
                'description' => 'Luxury attire for high-end events.',
                'status_id' => 1,
            ],
            [
                'name' => 'SportsStride',
                'description' => 'Athletic wear for everyday champions.',
                'status_id' => 1,
            ],
        ];

        foreach ($brands as $brand) {
            $createdBrand = Brand::create($brand);


            $categoryIds = range(1, 5);
            shuffle($categoryIds);
            $assignedCategories = array_slice($categoryIds, 0, rand(2, 4));
            $createdBrand->categories()->attach($assignedCategories);

            $tagIds = range(1, 5);
            shuffle($tagIds);
            $assignedTags = array_slice($tagIds, 0, rand(1, 3));
            $createdBrand->tags()->attach($assignedTags);
        }
    }
}
