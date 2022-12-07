<?php

namespace Database\Seeders;

use App\Models\DemonstrationMode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemonstrationModeSeeder extends Seeder
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
                'name' => 'Embedded in Content',
            ],
            [
                'name' => 'Embedded in View',
            ],
            [
                'name' => 'Standalone',
            ],
        ];
        foreach ($items as $item) {
            DemonstrationMode::create($item);
        }
    }
}
