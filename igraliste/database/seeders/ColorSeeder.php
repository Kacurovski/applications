<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Црвена', 'hex_code' => '#FF0000'],
            ['name' => 'Сина', 'hex_code' => '#0000FF'],
            ['name' => 'Зелена', 'hex_code' => '#008000'],
            ['name' => 'Жолта', 'hex_code' => '#FFFF00'],
            ['name' => 'Портокалова', 'hex_code' => '#FFA500'],
            ['name' => 'Виолетова', 'hex_code' => '#EE82EE'],
            ['name' => 'Розова', 'hex_code' => '#FFC0CB'],
            ['name' => 'Сива', 'hex_code' => '#808080'],
            ['name' => 'Црна', 'hex_code' => '#000000'],
            ['name' => 'Бела', 'hex_code' => '#FFFFFF'],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}
