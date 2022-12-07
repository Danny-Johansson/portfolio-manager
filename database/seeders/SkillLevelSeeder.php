<?php

namespace Database\Seeders;

use App\Models\SkillLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillLevelSeeder extends Seeder
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
                'name' => 'Beginner',
            ],
            [
                'name' => 'Intermediate',
            ],
            [
                'name' => 'Advanced',
            ],
            [
                'name' => 'Expert',
            ],
        ];
        foreach ($items as $item) {
            SkillLevel::create($item);
        }
    }
}
