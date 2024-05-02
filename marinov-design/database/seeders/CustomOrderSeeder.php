<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CustomOrder;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::where('role_id', 3)->first();
        $user2 = User::where('role_id', 3)->skip(1)->first();

        CustomOrder::create([
            'user_id' => $user1->id,
            'name' => $user1->name,
            'email' => $user1->email,
            'message' => 'Need a custom order for a special event.',
            'images' => json_encode(['1.jpg', '2.jpg']),
            'send_link' => 'https://example.com/custom-order',
        ]);

        CustomOrder::create([
            'user_id' => $user2->id,
            'name' => $user2->name,
            'email' => $user2->email,
            'message' => 'Interested in a custom design for a gift.',
            'images' => json_encode(['3.jpg']),
            'send_link' => 'https://example.com/custom-order/jane',
        ]);

    }
}
