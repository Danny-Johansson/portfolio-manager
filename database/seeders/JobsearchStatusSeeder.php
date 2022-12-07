<?php

namespace Database\Seeders;

use App\Models\JobsearchStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobsearchStatusSeeder extends Seeder
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
                'name' => 'Applied',
            ],
            [
                'name' => 'Accepted',
            ],
            [
                'name' => 'Rejected',
            ],
            [
                'name' => 'Followed Up',
            ],
            [
                'name' => 'Interview',
            ],
            [
                'name' => 'Abandoned',
            ],
        ];
        foreach ($items as $item) {
            JobsearchStatus::create($item);
        }
    }
}
