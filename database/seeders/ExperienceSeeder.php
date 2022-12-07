<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\ExperienceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
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
                'start_date' => '2018-01-01',
                'end_date' => '2022-11-18',
                'name' => 'Data- og Kommunikationsuddannelsen',
                'location' => 'Syddansk Erhvervsskole',
                'note' => 'Erhvervsuddannelse',
                'experience_type_id' => ExperienceType::where('name','=','Education')->first()->id
            ],
            [
                'start_date' => '2011-09-01',
                'end_date' => '2018-06-01',
                'name' => 'Bachelor i International Virksomhedskommunikation',
                'location' => 'Syddansk Universitet',
                'note' => 'Mellemlang Videregående Uddannelse',
                'experience_type_id' => ExperienceType::where('name','=','Education')->first()->id
            ],
            [
                'start_date' => '2009-08-01',
                'end_date' => '2011-12-01',
                'name' => '2-årig HF',
                'location' => 'VUC Fyn',
                'note' => 'Gymnasial Uddannelse',
                'experience_type_id' => ExperienceType::where('name','=','Education')->first()->id
            ],
            [
                'start_date' => '2008-08-01',
                'end_date' => '2008-12-01',
                'name' => 'Strøm, Styring og It',
                'location' => 'Syddansk Erhvervsskole',
                'note' => 'Erhvervsuddannelse',
                'experience_type_id' => ExperienceType::where('name','=','Education')->first()->id
            ],
            [
                'start_date' => '2017-09-01',
                'end_date' => '2017-12-01',
                'name' => 'Telefoninterviewer',
                'location' => 'Wilke Markedsanalyse',
                'note' => 'Telefoninterviewes',
                'experience_type_id' => ExperienceType::where('name','=','Work Experience')->first()->id
            ],
            [
                'start_date' => '2017-08-01',
                'end_date' => '2017-09-01',
                'name' => 'Pedelmedhjælper',
                'location' => 'Assens Kommune',
                'note' => 'forefaldende arbejde',
                'experience_type_id' => ExperienceType::where('name','=','Work Experience')->first()->id
            ],
            [
                'start_date' => '2016-08-01',
                'end_date' => '2016-09-01',
                'name' => 'Bud',
                'location' => 'FK Distribution',
                'note' => 'avisomdeling',
                'experience_type_id' => ExperienceType::where('name','=','Work Experience')->first()->id
            ],
            [
                'start_date' => '2004-06-01',
                'end_date' => '2008-06-01',
                'name' => 'Spejderleder',
                'location' => 'KFUM Spejderne Vissenbjerg',
                'note' => 'Planlægning af møder, afholdelse af møder',
                'experience_type_id' => ExperienceType::where('name','=','Volunteer Work')->first()->id
            ],
            [
                'start_date' => '2009-07-01',
                'end_date' => '2009-08-01',
                'name' => 'IT-Praktikant',
                'location' => 'Con E Com',
                'note' => 'Opsætning af PCer, opsætning af server, installation af PCer, installation af server,
webdesign',
                'experience_type_id' => ExperienceType::where('name','=','Other')->first()->id
            ],
        ];
        foreach ($items as $item) {
            Experience::create($item);
        }
    }
}
