<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Status;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        for ($i = 0; $i < 100; $i++) {
            $brand = Brand::inRandomOrder()->with('categories')->first();
            $category = $brand->categories->random();

            $product = Product::create([
                'name' => 'Product ' . ($i + 1),
                'description' => 'Description for Product ' . ($i + 1),
                'price' => rand(100, 10000), 
                'quantity' => rand(1, 100),
                'size_id' => Size::inRandomOrder()->first()->id,
                'size_advice' => 'совет за величина',
                'color_id' => Color::inRandomOrder()->first()->id,
                'brand_id' => $brand->id,
                'category_id' => $category->id,
                'status_id' => Status::inRandomOrder()->first()->id,
            ]);

            // Attach tags to product
            $randomTags = Tag::inRandomOrder()->take(rand(1, 5))->pluck('id');
            $product->tags()->attach($randomTags);
        }
    }
}