<?php

namespace Database\Seeders;

use App\Models\TagCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagCategorySeeder extends Seeder
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
                'name' => 'Language',
                'background_color' => '#FFFFFF',
                'text_color' => '#000000',
                'border_color' => '#000000',
            ],
            [
                'name' => 'Framework',
                'background_color' => '#FFFFFF',
                'text_color' => '#000000',
                'border_color' => '#000000',
            ],
            [
                'name' => 'Architecture',
                'background_color' => '#FFFFFF',
                'text_color' => '#000000',
                'border_color' => '#000000',
            ],
            [
                'name' => 'Authentication',
                'background_color' => '#FFFFFF',
                'text_color' => '#000000',
                'border_color' => '#000000',
            ],
            [
                'name' => 'Markup',
                'background_color' => '#FFFFFF',
                'text_color' => '#000000',
                'border_color' => '#000000',
            ],
            [
                'name' => 'Styling',
                'background_color' => '#FFFFFF',
                'text_color' => '#000000',
                'border_color' => '#000000',
            ],
            [
                'name' => 'Security',
                'background_color' => '#FFFFFF',
                'text_color' => '#000000',
                'border_color' => '#000000',
            ],
        ];
        foreach ($items as $item) {
            TagCategory::create($item);
        }
    }
}
