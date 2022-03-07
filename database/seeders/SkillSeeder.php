<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    //  import skills from .csv file 

    public function run()
    {
        // file path
        $csvFile = fopen(public_path("csv/skills.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                // insert to skills table
                DB::table('skills')->insert([
                    'name' => $data[0]
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
