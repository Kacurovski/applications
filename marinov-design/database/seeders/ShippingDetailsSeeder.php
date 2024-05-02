<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingDetail;

class ShippingDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShippingDetail::create([
            'user_id' => 1,
            'country' => 'Country1',
            'postal_zip_code' => '12345',
            'city' => 'City1',
            'address' => 'Address1',
        ]);

        ShippingDetail::create([
            'user_id' => 1,
            'country' => 'Country2',
            'postal_zip_code' => '67890',
            'city' => 'City2',
            'address' => 'Address2',
        ]);
    }
}
