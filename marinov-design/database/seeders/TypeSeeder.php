<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Helmet', 'category_id' => 2],
            ['name' => 'Ring', 'category_id' => 1],
            ['name' => 'Braccelet', 'category_id' => 1],
            ['name' => 'Gold Ring', 'category_id' => 1],
            ['name' => 'Silver Ring', 'category_id' => 1],
            ['name' => 'Necklace', 'category_id' => 1],
            ['name' => 'Gold', 'category_id' => 1],
            ['name' => 'Silver', 'category_id' => 1],
        ];

        foreach ($types as $typeData) {
            Type::create($typeData);
        }
    }
}
