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
        $this->call([
        	RoomsTableSeeder::class,
        	CoursesTableSeeder::class,
            LabsTableSeeder::class,
        	FacultiesTableSeeder::class,
            LabAssistantsTableSeeder::class,
        	SectionsTableSeeder::class,
        	AllocationsTableSeeder::class
        ]);
    }
}
