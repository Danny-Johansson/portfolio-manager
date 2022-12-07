<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\SkillLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $beginner = SkillLevel::where('name','=','Beginner')->first()->id;
        $intermediate = SkillLevel::where('name','=','Intermediate')->first()->id;
        $expert = SkillLevel::where('name','=','Expert')->first()->id;

        $items = [
            [
                'name' => 'Microsoft Office',
                'skill_level_id' => $expert
            ],
            [
                'name' => 'Photoshop',
                'skill_level_id' => $expert
            ],
            [
                'name' => 'HTML5',
                'skill_level_id' => $expert
            ],
            [
                'name' => 'Javascript',
                'skill_level_id' => $expert
            ],
            [
                'name' => 'CSS3',
                'skill_level_id' => $expert
            ],
            [
                'name' => 'PHP',
                'skill_level_id' => $expert
            ],
            [
                'name' => 'MySQL',
                'skill_level_id' => $expert
            ],
            [
                'name' => 'Wordpress',
                'skill_level_id' => $intermediate
            ],
            [
                'name' => 'Bootstrap',
                'skill_level_id' => $expert
            ],
            [
                'name' => 'Github',
                'skill_level_id' => $expert
            ],
            [
                'name' => 'C / C++ / C#',
                'skill_level_id' => $intermediate
            ],
            [
                'name' => 'Dot Net ( .Net )',
                'skill_level_id' => $beginner
            ],
            [
                'name' => 'App Development (Xamarin / MAUI)',
                'skill_level_id' => $beginner
            ],
            [
                'name' => 'Java',
                'skill_level_id' => $beginner
            ],
            [
                'name' => 'Ruby on Rails',
                'skill_level_id' => $beginner
            ],
            [
                'name' => 'Angular',
                'skill_level_id' => $beginner
            ],
            [
                'name' => 'React.js',
                'skill_level_id' => $beginner
            ],
            [
                'name' => 'Node.js',
                'skill_level_id' => $beginner
            ],
            [
                'name' => 'vue.js / nuxt.js',
                'skill_level_id' => $beginner
            ],
            [
                'name' => 'Embedded Controller',
                'skill_level_id' => $beginner
            ],
        ];
        foreach ($items as $item) {
            Skill::create($item);
        }
    }
}
