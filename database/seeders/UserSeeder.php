<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'name' => 'Demo Account',
                'email' => 'demo@danny-johansson.online',
                'password' => Hash::make('Pass.1234'),
                'role_id' => Role::where('name','=','Demonstration')->first()->id,
            ]
        ];
        foreach ($items as $item) {
            User::create($item);
        }
    }
}
