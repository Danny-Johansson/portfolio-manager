<?php

namespace Database\Seeders;

use App\Models\Demonstration;
use App\Models\DemonstrationType;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemonstrationSeeder extends Seeder
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
                'name' => 'Rotating 3D Dice',
                'file' => 'demos/Rotating 3D Dice.html',
                'demonstration_type_id' => DemonstrationType::where('name','=','CSS Animation')->first()->id
            ],
        ];
        foreach ($items as $item) {
            Demonstration::create($item);
        }

        $dice_tags = [
            Tag::where('name','=','HTML5')->first()->id,
            Tag::where('name','=','CSS3')->first()->id,
        ];

        Demonstration::where('name','=','Rotating 3D Dice')->first()->tags()->sync($dice_tags);
    }


}
