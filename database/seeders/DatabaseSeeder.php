<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\FieldSeeder;
use Database\Seeders\SkillSeeder;
use Database\Seeders\AcademySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AcademySeeder::class,
            SkillSeeder::class
        ]);
    }
}
