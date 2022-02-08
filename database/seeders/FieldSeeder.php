<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert field name to fields table

        $fields = [
            [
                'name' => 'Marketing'
            ],
            [
                'name' => 'Frontend Development'
            ],
            [
                'name' => 'Backend Development'
            ],
            [
                'name' => 'Data Science'
            ],
            [
                'name' => 'Design'
            ],
            [
                'name' => 'QA'
            ],
            [
                'name' => 'UI/UX'
            ]
        ];

        DB::table('fields')->insert($fields);
    }
}
