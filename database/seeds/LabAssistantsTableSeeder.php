<?php

use Illuminate\Database\Seeder;

class LabAssistantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lab_assistants')->insert([
        	['faculty_id' => 36],
        	['faculty_id' => 37]
        ]);
    }
}
