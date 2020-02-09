<?php

use Illuminate\Database\Seeder;

class LabsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('labs')->insert([
        	['course_code' => 'EE321'],
        	['course_code' => 'CS344']
        ]);
    }
}
