<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            ['name' => 'Gold'],
            ['name' => 'Silver'],
            ['name' => 'Bronze'],
            ['name' => 'Platinum'],
            ['name' => 'Diamond'],
            ['name' => 'Ruby'],
            ['name' => 'Sapphire'],
            ['name' => 'Emerald'],
        ];

        foreach ($materials as $materialData) {
            Material::create($materialData);
        }
    }
}
