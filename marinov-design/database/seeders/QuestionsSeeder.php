<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 8; $i++) {
            $questions[] = [
                'name' => fake()->name(),
                'email' => fake()->safeEmail(),
                'question' => fake()->sentence($nbWords = 6, $variableNbWords = true),
            ];
        }

        DB::table('questions')->insert($questions);
    }
}
