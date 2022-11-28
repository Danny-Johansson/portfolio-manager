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
    public function run()
    {
        $items = [
            [
                'name' => 'Layout',
            ],
            [
                'name' => 'Animation',
            ],
        ];
        foreach ($items as $item) {
            DemonstrationType::create($item);
        }
    }
}
