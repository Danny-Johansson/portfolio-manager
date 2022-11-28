<?php

namespace Database\Seeders;

use App\Models\CertificateIssuer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificateIssuerSeeder extends Seeder
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
                'name' => 'Microsoft',
            ],
            [
                'name' => 'Cisco',
            ],
            [
                'name' => 'Pearson',
            ],
            [
                'name' => 'Certiport',
            ],
        ];
        foreach ($items as $item) {
            CertificateIssuer::create($item);
        }
    }
}
