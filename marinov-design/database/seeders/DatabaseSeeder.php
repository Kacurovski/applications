<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Coupon;
use App\Models\Maintenance;
use App\Models\Material;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ShippingDetail;
use App\Models\Type;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            TypeSeeder::class,
            ProductSeeder::class,
            CommentSeeder::class,
            MaintenanceSeeder::class,
            MaterialSeeder::class,
            ProductImageSeeder::class,
            AdminSeeder::class,
            FaqSeeder::class,
            ShippingDetailsSeeder::class,
            OrderSeeder::class,
            UsersTableSeeder::class,
            UserCartProductsSeeder::class,
            UsersFavoriteProductsSeeder::class,
            OrderProductSeeder::class,
            CustomOrderSeeder::class,
            GiftCardSeeder::class,
            CouponSeeder::class,
            MaterialProductSeeder::class,
            QuestionsSeeder::class,
        ]);
    }
}
