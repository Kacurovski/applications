<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coupons')->insert([
            [
                'code' => 'COUPON1',
                'discount' => 10.00,
            ],
            [
                'code' => 'COUPON2',
                'discount' => 20.00,
            ],
            [
                'code' => 'COUPON3',
                'discount' => 30.00,
            ],
            [
                'code' => 'COUPON4',
                'discount' => 40.00,
            ],
            [
                'code' => 'COUPON5',
                'discount' => 50.00,
            ],
            [
                'code' => 'COUPON6',
                'discount' => 60.00,
            ],
            [
                'code' => 'COUPON7',
                'discount' => 70.00,
            ],
            [
                'code' => 'COUPON8',
                'discount' => 80.00,
            ],
            [
                'code' => 'COUPON9',
                'discount' => 90.00,
            ],
            [
                'code' => 'COUPON10',
                'discount' => 100.00,
            ],
        ]);
    }
}
