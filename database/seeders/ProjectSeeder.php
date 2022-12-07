<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
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
                'name' => 'Portfolio, Resume and Jobsearch System',
                'demo_url' => 'https://portfolio.danny-johansson.online',
                'repo_url' => 'https://github.com/Danny-Johansson/portfolio-manager',
                'note' => 'This system'
            ],

        ];
        foreach ($items as $item) {
            Project::create($item);
        }

        $default_features = [
            Feature::where('name','=','Managing Resume')->first()->id,
            Feature::where('name','=','Managing Projects')->first()->id,
            Feature::where('name','=','Managing Demonstrations')->first()->id,
            Feature::where('name','=','User & Login System')->first()->id,
            Feature::where('name','=','Roles & Permission System')->first()->id,
            Feature::where('name','=','Create Read Update Delete Functionality')->first()->id,
            Feature::where('name','=','Soft Delete System')->first()->id,
            Feature::where('name','=','Tagging System')->first()->id,
            Feature::where('name','=','Translation Support')->first()->id,
            Feature::where('name','=','File Upload')->first()->id,
            Feature::where('name','=','Modularity and Scalability')->first()->id,
        ];
        $default_tags = [
            Tag::where('name','=','Laravel')->first()->id,
            Tag::where('name','=','Bootstrap')->first()->id,
            Tag::where('name','=','PHP')->first()->id,
            Tag::where('name','=','CSS3')->first()->id,
            Tag::where('name','=','HTML5')->first()->id,
            Tag::where('name','=','MVC')->first()->id,
            Tag::where('name','=','Basic')->first()->id,
        ];

        Project::where('name','=','Portfolio, Resume and Jobsearch System')->first()->features()->sync($default_features);
        Project::where('name','=','Portfolio, Resume and Jobsearch System')->first()->tags()->sync($default_tags);
    }
}
