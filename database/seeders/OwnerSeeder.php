<?php

namespace Database\Seeders;

use App\Models\Owner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
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
                'image' => 'images/owner.jpg',
                'first_name' => 'Danny',
                'last_name' => 'Johansson',
                'birthday' => '1989-03-01',
                'city' => 'Odense',
                'country' => 'Denmark',
                'email' => 'danny@danny-johansson.online',
                'license' => 1,
            ],
        ];
        foreach ($items as $item) {
            Owner::create($item);
        }
    }
}
