<?php

namespace Database\Seeders;

use App\Models\Maintenance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maintenances = [
            ['title' => 'Regular Dusting', 'text' => 'Dust your furniture regularly with a clean, dry, and soft cloth.'],
            ['title' => 'Gentle Cleaning', 'text' => 'Clean your furniture with a soft, damp cloth.'],
            ['title' => 'Natural Patina', 'text' => 'Natural patina is a result of the wood aging.'],
            ['title' => 'Avoid Moisture', 'text' => 'Avoid placing your furniture in direct sunlight or near a heat source.'],
            ['title' => 'Storage', 'text' => 'Store your furniture in a dry and cool place.'],
            ['title' => 'No Harsh Chemicals', 'text' => 'Avoid using harsh chemicals on your furniture.'],
        ];

        foreach ($maintenances as $maintenanceData) {
            Maintenance::create($maintenanceData);
        }
    }
}
