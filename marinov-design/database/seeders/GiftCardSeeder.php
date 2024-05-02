<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\GiftCard;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GiftCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('id', '!=', 1)->get();

        foreach ($users as $user) {
            GiftCard::create([
                'code' => 'MARINOV-' . uniqid(),
                'value' => rand(10, 100),
                'is_redeemed' => false,
                'user_id' => $user->id,
            ]);
        }
    }
}
