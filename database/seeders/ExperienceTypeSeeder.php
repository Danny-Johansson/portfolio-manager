<?php

namespace Database\Seeders;

use App\Models\ExperienceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceTypeSeeder extends Seeder
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
                'name' => 'Education',
            ],
            [
                'name' => 'Work Experience',
            ],
            [
                'name' => 'Volunteer Work',
            ],
            [
                'name' => 'Other',
            ],
        ];
        foreach ($items as $item) {
            ExperienceType::create($item);
        }
    }
}
