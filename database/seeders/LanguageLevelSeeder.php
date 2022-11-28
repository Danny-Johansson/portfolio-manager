<?php

namespace Database\Seeders;

use App\Models\LanguageLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name' => 'Beginner',
            ],
            [
                'name' => 'Intermediate',
            ],
            [
                'name' => 'Conversational',
            ],
            [
                'name' => 'Fluent',
            ],
        ];
        foreach ($items as $item) {
            LanguageLevel::create($item);
        }
    }
}
