<?php

namespace Database\Seeders;

use App\Models\DemonstrationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemonstrationTypeSeeder extends Seeder
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
                'name' => 'Layout',
            ],
            [
                'name' => 'Colorscheme',
            ],
            [
                'name' => 'CSS Animation',
            ],
            [
                'name' => 'Art',
            ],
            [
                'name' => 'Component',
            ],
        ];
        foreach ($items as $item) {
            DemonstrationType::create($item);
        }
    }
}
