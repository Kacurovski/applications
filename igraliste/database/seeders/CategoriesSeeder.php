<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            'Блуза',        
            'Фармерка',    
            'Пантолони',  
            'Фустан',     
            'Маица',        
            'Јакна',       
            'Сукња',       
            'Чевли',       
            'Чанта',         
        ];
    
        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
            ]);
        }
    }
}
