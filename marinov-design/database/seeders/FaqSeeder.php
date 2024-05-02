<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'What is Lorem Ipsum?',
                'answer' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            ],
            [
                'question' => 'How can I install Laravel?',
                'answer' => 'You can install Laravel using Composer. Run "composer create-project --prefer-dist laravel/laravel project-name" in your terminal.',
            ],
        ];

        Faq::insert($faqs);

    }
}
