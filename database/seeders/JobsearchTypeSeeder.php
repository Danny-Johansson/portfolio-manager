<?php

namespace Database\Seeders;

use App\Models\JobsearchType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobsearchTypeSeeder extends Seeder
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
                'name' => 'Job Database',
            ],
            [
                'name' => 'Email',
            ],
            [
                'name' => 'Phone',
            ],
            [
                'name' => 'Physical Copy',
            ],
            [
                'name' => 'Meeting',
            ],
        ];
        foreach ($items as $item) {
            JobsearchType::create($item);
        }
    }
}
