<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\CertificateIssuer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $cisco = CertificateIssuer::where('name','=','Cisco')->first()->id;
        $certiport = CertificateIssuer::where('name','=','Certiport')->first()->id;
        $file = 'files/';
        $extension = '.pdf';

        $items = [
            [
                'name' => 'Microsoft Technology Associate: 98-366 Network Fundamentals',
                'earn_date' => '2018-06-01',
                'expire_date' => '2023-06-01',
                'note' => Null,
                'file' => $file."Microsoft Technology Associate 98-366 Network Fundamentals".$extension,
                'certificate_issuer_id' => $certiport
            ],
            [
                'name' => 'Microsoft Technology Associate: 98-369 Cloud Fundamentals',
                'earn_date' => '2018-06-01',
                'expire_date' => '2023-06-01',
                'note' => Null,
                'file' => $file."Microsoft Technology Associate 98-369 Cloud Fundamentals".$extension,
                'certificate_issuer_id' => $certiport
            ],
            [
                'name' => 'Microsoft Technology Associate: 98-382 Introduction to Programming using JavaScript',
                'earn_date' => '2018-06-01',
                'expire_date' => '2023-06-01',
                'note' => Null,
                'file' => $file."Microsoft Technology Associate 98-382 Introduction to Programming using JavaScript".$extension,
                'certificate_issuer_id' => $certiport
            ],
            [
                'name' => 'Microsoft Technology Associate: 98-383 Introduction to Programming with HTML and CSS',
                'earn_date' => '2018-06-01',
                'expire_date' => '2023-06-01',
                'note' => Null,
                'file' => $file."Microsoft Technology Associate 98-383 Introduction to Programming with HTML and CSS".$extension,
                'certificate_issuer_id' => $certiport
            ],
            [
                'name' => 'Microsoft Technology Associate: 98-349 Windows Operating Systems Fundamentals',
                'earn_date' => '2018-05-01',
                'expire_date' => '2023-05-01',
                'note' => Null,
                'file' => $file."Microsoft Technology Associate 98-349 Windows Operating Systems Fundamentals".$extension,
                'certificate_issuer_id' => $certiport
            ],
            [
                'name' => 'Microsoft Technology Associate: 98-365 Windows Server Administration Fundamentals',
                'earn_date' => '2018-05-01',
                'expire_date' => '2023-05-01',
                'note' => Null,
                'file' => $file."Microsoft Technology Associate 98-365 Windows Server Administration Fundamentals".$extension,
                'certificate_issuer_id' => $certiport
            ],
            [
                'name' => 'Microsoft Technology Associate: 98-367 Security Fundamentals',
                'earn_date' => '2018-05-01',
                'expire_date' => '2023-05-01',
                'note' => Null,
                'file' => $file."Microsoft Technology Associate 98-367 Security Fundamentals".$extension,
                'certificate_issuer_id' => $certiport
            ],
            [
                'name' => 'Microsoft Technology Associate: 98-361 Software Development Fundamentals (C#)',
                'earn_date' => '2018-04-01',
                'expire_date' => '2023-04-01',
                'note' => Null,
                'file' => $file."Microsoft Technology Associate 98-361 Software Development Fundamentals (C#)".$extension,
                'certificate_issuer_id' => $certiport
            ],
            [
                'name' => 'Microsoft Technology Associate: 98-364 Database Administration Fundamentals',
                'earn_date' => '2018-04-01',
                'expire_date' => '2023-04-01',
                'note' => Null,
                'file' => $file."Microsoft Technology Associate 98-364 Database Administration Fundamentals".$extension,
                'certificate_issuer_id' => $certiport
            ],
            [
                'name' => 'Microsoft Technology Associate: 98-368 Mobility and Device Fundamentals',
                'earn_date' => '2018-04-01',
                'expire_date' => '2023-04-01',
                'note' => Null,
                'file' => $file."Microsoft Technology Associate 98-368 Mobility and Device Fundamentals".$extension,
                'certificate_issuer_id' => $certiport
            ],
            [
                'name' => 'Microsoft Technology Associate: 98-375 HTML5 Application Development Fundamentals',
                'earn_date' => '2018-03-01',
                'expire_date' => '2023-03-01',
                'note' => Null,
                'file' => $file."Microsoft Technology Associate 98-375 HTML5 Application Development Fundamentals".$extension,
                'certificate_issuer_id' => $certiport
            ],
            [
                'name' => 'Cisco CCNA Routing and Switching: Introduction to Networks',
                'earn_date' => '2018-02-01',
                'expire_date' => '2021-02-01',
                'note' => Null,
                'file' => $file."Cisco CCNA Routing and Switching Introduction to Networks".$extension,
                'certificate_issuer_id' => $cisco
            ],
        ];
        foreach ($items as $item) {
            Certificate::create($item);
        }
    }
}
