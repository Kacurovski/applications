<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regularRole = Role::where('name', 'Regular')->first();
        $adminRole = Role::where('name', 'Admin')->first();

        User::create([
            'name' => 'John Doe',
            'surname' => 'Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role_id' => $regularRole->id,
        ]);

        User::create([
            'name' => 'Jane Doe',
            'surname' => 'Doe',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role_id' => $regularRole->id,
        ]);

        User::create([
            'name' => 'Bob Smith',
            'surname' => 'Smith',
            'email' => 'bob@example.com',
            'password' => Hash::make('password'),
            'role_id' => $regularRole->id,
        ]);

        User::create([
            'name' => 'Admin',
            'surname' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'phone_number' => 123456789,
            'role_id' => $adminRole->id,
        ]);
    }
}
