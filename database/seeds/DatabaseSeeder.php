<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AdminSeeder::class);
         $this->call(DocumentSeeder::class);
         $this->call(EducationSeeder::class);
         $this->call(PageSeeder::class);
         $this->call(ProfessionSeeder::class);
         $this->call(RegionSeeder::class);
         $this->call(SpecialtiesTypeSeeder::class);
         $this->call(SpecialtySeeder::class);
    }
}
