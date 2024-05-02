<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));

        foreach (range(1, 10) as $index) { 
            Vehicle::create([
                'brand' => $faker->vehicleBrand,
                'model' => $faker->vehicleModel,
                'plate_number' => $faker->vehicleRegistration,
                'insurance_date' => $faker->date(),
            ]);
        }
    }
}
