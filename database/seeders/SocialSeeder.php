<?php

namespace Database\Seeders;

use App\Models\Social;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
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
                'name' => 'LinkedIn',
                'link' => 'https://www.linkedin.com/in/danny-johansson-14164259/',
                'logo' => 'images/LinkedIn.png',
            ],
        ];
        foreach ($items as $item) {
            Social::create($item);
        }
    }
}
