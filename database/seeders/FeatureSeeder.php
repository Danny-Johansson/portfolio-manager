<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
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
                'name' => 'User & Login System',
            ],
            [
                'name' => 'Roles & Permission System',
            ],
            [
                'name' => 'Create Read Update Delete Functionality',
            ],
            [
                'name' => 'Soft Delete System',
            ],
            [
                'name' => 'Tagging System',
            ],
            [
                'name' => 'Translation Support',
            ],
            [
                'name' => 'File Upload',
            ],
            [
                'name' => 'Managing Projects',
            ],
            [
                'name' => 'Managing Resume',
            ],
            [
                'name' => 'Managing Demonstrations',
            ],
            [
                'name' => 'Modularity and Scalability',
            ],
            [
                'name' => 'Steam Integration',
            ],
            [
                'name' => 'Patreon Integration',
            ],
            [
                'name' => 'Discord Integration',
            ],
            [
                'name' => 'Google Integration',
            ],
            [
                'name' => 'Facebook Integration',
            ],
            [
                'name' => 'Twitter Integration',
            ],
            [
                'name' => 'API',
            ],
            [
                'name' => 'Swagger Documentation',
            ],
        ];
        foreach ($items as $item) {
            Feature::create($item);
        }
    }
}
