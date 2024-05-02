<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $faker = Faker::create();

        foreach ($products as $product) {
            $numImages = $faker->numberBetween(2, 5);

            for ($i = 0; $i < $numImages; $i++) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $faker->imageUrl(),
                ]);
            }
        }
    }
}
