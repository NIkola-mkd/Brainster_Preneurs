<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //insert data to academies table (academy name and profession name )

        $academies = [
            [
                'name' => 'Marketing',
                'profession' => 'Marketer'
            ],
            [
                'name' => 'Frontend Development',
                'profession' => 'Frontend Developer'
            ],
            [
                'name' => 'Backend Development',
                'profession' => 'Backend Developer'
            ],
            [
                'name' => 'Data Science',
                'profession' => 'Data Scientist'
            ],
            [
                'name' => 'Design',
                'profession' => 'Designer'
            ],
            [
                'name' => 'QA',
                'profession' => 'QA Tester'
            ],
            [
                'name' => 'UI/UX',
                'profession' => 'UI/UX Designer'
            ]
        ];

        DB::table('academies')->insert($academies);
    }
}
