<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'Owner'],
            ['name' => 'Demonstration'],
        ];
        foreach ($items as $item) {
            Role::create($item);
        }

        Role::where('name', '=', 'Owner')->first()->permissions()->sync(Permission::all());
    }
}
