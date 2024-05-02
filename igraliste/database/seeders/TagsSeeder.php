<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Tag::create(['name' => 'ново']);
        Tag::create(['name' => 'vintage']);
        Tag::create(['name' => 'палта']);
        Tag::create(['name' => 'облека']);
        Tag::create(['name' => 'trendy']);
    }
}
