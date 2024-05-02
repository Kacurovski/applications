<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 0; $i <= 9; $i++) {
            Project::create([
                'url' => fake()->url(), //Some of the faker urls might not work
                'name' => fake()->words(3, true),
                'subtitle' => fake()->sentence(),
                'description' => fake()->paragraph(),
                'image' => fake()->imageUrl(640, 480, 'nature', true),
            ]);
        }
    }
}
