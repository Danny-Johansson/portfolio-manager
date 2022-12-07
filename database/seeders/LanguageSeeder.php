<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\LanguageLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {

        $items = [
            [
                'name' => 'Danish',
                'speak' => LanguageLevel::where('name','=','Fluent')->first()->id,
                'read' => LanguageLevel::where('name','=','Fluent')->first()->id,
                'write' => LanguageLevel::where('name','=','Fluent')->first()->id,
                'understand' => LanguageLevel::where('name','=','Fluent')->first()->id,
            ],
            [
                'name' => 'English',
                'speak' => LanguageLevel::where('name','=','Fluent')->first()->id,
                'read' => LanguageLevel::where('name','=','Fluent')->first()->id,
                'write' => LanguageLevel::where('name','=','Fluent')->first()->id,
                'understand' => LanguageLevel::where('name','=','Fluent')->first()->id,
            ],
            [
                'name' => 'German',
                'speak' => LanguageLevel::where('name','=','Beginner')->first()->id,
                'read' => LanguageLevel::where('name','=','Beginner')->first()->id,
                'write' => LanguageLevel::where('name','=','Beginner')->first()->id,
                'understand' => LanguageLevel::where('name','=','Beginner')->first()->id,
            ],
        ];
        foreach ($items as $item) {
            Language::create($item);
        }
    }
}
