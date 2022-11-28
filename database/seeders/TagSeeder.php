<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\TagCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $framework = TagCategory::where('name','=','Framework')->first()->id;
        $language = TagCategory::where('name','=','Language')->first()->id;
        $architecture = TagCategory::where('name','=','Architecture')->first()->id;
        $authentication = TagCategory::where('name','=','Authentication')->first()->id;
        $markup = TagCategory::where('name','=','Markup')->first()->id;
        $styling = TagCategory::where('name','=','Styling')->first()->id;
        $security = TagCategory::where('name','=','Security')->first()->id;

        $items = [
            [
                'name' => 'Laravel',
                'tag_category_id' => $framework
            ],
            [
                'name' => 'PHP',
                'tag_category_id' => $language
            ],
            [
                'name' => 'Javascript',
                'tag_category_id' => $language
            ],
            [
                'name' => 'Go',
                'tag_category_id' => $language
            ],
            [
                'name' => 'Python',
                'tag_category_id' => $language
            ],
            [
                'name' => "Ren'Py",
                'tag_category_id' => $language
            ],
            [
                'name' => 'Ruby',
                'tag_category_id' => $language
            ],
            [
                'name' => 'C',
                'tag_category_id' => $language
            ],
            [
                'name' => 'C++',
                'tag_category_id' => $language
            ],
            [
                'name' => 'C#',
                'tag_category_id' => $language
            ],
            [
                'name' => 'Ruby on Rails',
                'tag_category_id' => $framework
            ],
            [
                'name' => 'Dot Net (.net)',
                'tag_category_id' => $framework
            ],
            [
                'name' => 'CSS3',
                'tag_category_id' => $styling
            ],
            [
                'name' => 'Bootstrap',
                'tag_category_id' => $styling
            ],
            [
                'name' => 'Tailwind',
                'tag_category_id' => $styling
            ],
            [
                'name' => 'Tailwind',
                'tag_category_id' => $styling
            ],
            [
                'name' => 'MVC',
                'tag_category_id' => $architecture
            ],
            [
                'name' => 'MVVM',
                'tag_category_id' => $architecture
            ],
            [
                'name' => 'OpenAuth',
                'tag_category_id' => $authentication
            ],
            [
                'name' => 'Auth0',
                'tag_category_id' => $authentication
            ],
            [
                'name' => 'Basic',
                'tag_category_id' => $authentication
            ],
            [
                'name' => 'Bearer Token',
                'tag_category_id' => $authentication
            ],
            [
                'name' => 'JWT',
                'tag_category_id' => $authentication
            ],
            [
                'name' => 'API Key',
                'tag_category_id' => $authentication
            ],
            [
                'name' => 'HTML5',
                'tag_category_id' => $markup
            ],
            [
                'name' => 'XML',
                'tag_category_id' => $markup
            ],
            [
                'name' => 'Markdown',
                'tag_category_id' => $markup
            ]

        ];
        foreach ($items as $item) {
            Tag::create($item);
        }
    }
}
