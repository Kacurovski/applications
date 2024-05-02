<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsData = [
            [
                'title' => 'Coper Helmet',
                'description' => 'Description for Product 1',
                'price' => 100.00,
                'sale_price' => 90.00,
                'is_featured' => true,
                'category_id' => Category::where('name', 'Jewelry')->first()->id,
                'type_id' => Type::where('name', 'Helmet')->first()->id,
                'dimensions' => '20 x 30 cm',
                'weight' => 2.5,
                'quantity' => 50,
                'is_discounted' => true,
            ],
            [
                'title' => 'Silver Ring',
                'description' => 'Description for Product 2',
                'price' => 120.00,
                'sale_price' => 110.00,
                'is_featured' => false,
                'category_id' => Category::where('name', 'Home Decor')->first()->id,
                'type_id' => Type::where('name', 'Silver Ring')->first()->id,
                'dimensions' => '25 x 35 cm',
                'weight' => 3.0,
                'quantity' => 30,
                'is_discounted' => false,
            ],
            [
                'title' => 'Necklace Gold',
                'description' => 'Description for Product 2',
                'price' => 120.00,
                'sale_price' => 110.00,
                'is_featured' => false,
                'category_id' => Category::where('name', 'Home Decor')->first()->id,
                'type_id' => Type::where('name', 'Necklace')->first()->id,
                'dimensions' => '25 x 35 cm',
                'weight' => 3.0,
                'quantity' => 30,
                'is_discounted' => false,
            ],
            [
                'title' => 'Diamond Ring',
                'description' => 'Description for Product 2',
                'price' => 120.00,
                'sale_price' => 110.00,
                'is_featured' => false,
                'category_id' => Category::where('name', 'Jewelry')->first()->id,
                'type_id' => Type::where('name', 'Ring')->first()->id,
                'dimensions' => '25 x 35 cm',
                'weight' => 3.0,
                'quantity' => 30,
                'is_discounted' => false,
            ],
            [
                'title' => 'Diamond Braccelet',
                'description' => 'Description for Product 2',
                'price' => 120.00,
                'sale_price' => 110.00,
                'is_featured' => false,
                'category_id' => Category::where('name', 'Jewelry')->first()->id,
                'type_id' => Type::where('name', 'Braccelet')->first()->id,
                'dimensions' => '25 x 35 cm',
                'weight' => 3.0,
                'quantity' => 30,
                'is_discounted' => false,
            ],
            [
                'title' => 'Silver Braccelet',
                'description' => 'Description for Product 2',
                'price' => 120.00,
                'sale_price' => 110.00,
                'is_featured' => false,
                'category_id' => Category::where('name', 'Jewelry')->first()->id,
                'type_id' => Type::where('name', 'Braccelet')->first()->id,
                'dimensions' => '25 x 35 cm',
                'weight' => 3.0,
                'quantity' => 30,
                'is_discounted' => false,
            ],
            [
                'title' => 'Gold Ring',
                'description' => 'Description for Product 2',
                'price' => 120.00,
                'sale_price' => 110.00,
                'is_featured' => false,
                'category_id' => Category::where('name', 'Jewelry')->first()->id,
                'type_id' => Type::where('name', 'Gold Ring')->first()->id,
                'dimensions' => '25 x 35 cm',
                'weight' => 3.0,
                'quantity' => 30,
                'is_discounted' => false,
            ],
            [
                'title' => 'Coper Braccelet',
                'description' => 'Description for Product 2',
                'price' => 120.00,
                'sale_price' => 110.00,
                'is_featured' => false,
                'category_id' => Category::where('name', 'Jewelry')->first()->id,
                'type_id' => Type::where('name', 'Braccelet')->first()->id,
                'dimensions' => '25 x 35 cm',
                'weight' => 3.0,
                'quantity' => 30,
                'is_discounted' => false,
            ],
            [
                'title' => 'Gold 1',
                'description' => 'Description for Product 2',
                'price' => 120.00,
                'sale_price' => 110.00,
                'is_featured' => false,
                'category_id' => Category::where('name', 'Jewelry')->first()->id,
                'type_id' => Type::where('name', 'Gold')->first()->id,
                'dimensions' => '25 x 35 cm',
                'weight' => 3.0,
                'quantity' => 30,
                'is_discounted' => false,
            ],
            [
                'title' => 'Gold 2',
                'description' => 'Description for Product 2',
                'price' => 120.00,
                'sale_price' => 110.00,
                'is_featured' => false,
                'category_id' => Category::where('name', 'Jewelry')->first()->id,
                'type_id' => Type::where('name', 'Gold')->first()->id,
                'dimensions' => '25 x 35 cm',
                'weight' => 3.0,
                'quantity' => 30,
                'is_discounted' => false,
            ],
            [
                'title' => 'Silver 2',
                'description' => 'Description for Product 2',
                'price' => 120.00,
                'sale_price' => 110.00,
                'is_featured' => false,
                'category_id' => Category::where('name', 'Jewelry')->first()->id,
                'type_id' => Type::where('name', 'Silver')->first()->id,
                'dimensions' => '25 x 35 cm',
                'weight' => 3.0,
                'quantity' => 30,
                'is_discounted' => false,
            ],
            [
                'title' => 'Silver Ring 2',
                'description' => 'Description for Product 2',
                'price' => 120.00,
                'sale_price' => 110.00,
                'is_featured' => false,
                'category_id' => Category::where('name', 'Jewelry')->first()->id,
                'type_id' => Type::where('name', 'Silver Ring')->first()->id,
                'dimensions' => '25 x 35 cm',
                'weight' => 3.0,
                'quantity' => 30,
                'is_discounted' => false,
            ],
        ];

        foreach ($productsData as $productData) {
            Product::create($productData);
        }
    }
}
