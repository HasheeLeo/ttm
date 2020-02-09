<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
        	['name' => 'A', 'department' => 'EE', 'batch_id' => 2014, 'batch_name' => 6],
        	['name' => 'B', 'department' => 'EE', 'batch_id' => 2014, 'batch_name' => 6],
        	['name' => 'C', 'department' => 'EE', 'batch_id' => 2014, 'batch_name' => 6],
        	['name' => 'D', 'department' => 'EE', 'batch_id' => 2014, 'batch_name' => 6],

        	['name' => 'A', 'department' => 'EE', 'batch_id' => 2015, 'batch_name' => 7],
        	['name' => 'B', 'department' => 'EE', 'batch_id' => 2015, 'batch_name' => 7],
        	['name' => 'C', 'department' => 'EE', 'batch_id' => 2015, 'batch_name' => 7],
        	['name' => 'D', 'department' => 'EE', 'batch_id' => 2015, 'batch_name' => 7],

        	['name' => 'A', 'department' => 'EE', 'batch_id' => 2016, 'batch_name' => 8],
        	['name' => 'B', 'department' => 'EE', 'batch_id' => 2016, 'batch_name' => 8],
        	['name' => 'C', 'department' => 'EE', 'batch_id' => 2016, 'batch_name' => 8],
        	['name' => 'D', 'department' => 'EE', 'batch_id' => 2016, 'batch_name' => 8],

        	['name' => 'A', 'department' => 'EE', 'batch_id' => 2017, 'batch_name' => 9],
        	['name' => 'B', 'department' => 'EE', 'batch_id' => 2017, 'batch_name' => 9],
        	['name' => 'C', 'department' => 'EE', 'batch_id' => 2017, 'batch_name' => 9],
        	['name' => 'D', 'department' => 'EE', 'batch_id' => 2017, 'batch_name' => 9],

        	['name' => 'A', 'department' => 'SE', 'batch_id' => 2014, 'batch_name' => 5],
        	['name' => 'B', 'department' => 'SE', 'batch_id' => 2014, 'batch_name' => 5],

        	['name' => 'A', 'department' => 'SE', 'batch_id' => 2015, 'batch_name' => 6],
        	['name' => 'B', 'department' => 'SE', 'batch_id' => 2015, 'batch_name' => 6],

        	['name' => 'A', 'department' => 'SE', 'batch_id' => 2016, 'batch_name' => 7],
        	['name' => 'B', 'department' => 'SE', 'batch_id' => 2016, 'batch_name' => 7],

        	['name' => 'A', 'department' => 'SE', 'batch_id' => 2017, 'batch_name' => 8],
        	['name' => 'B', 'department' => 'SE', 'batch_id' => 2017, 'batch_name' => 8],

        	['name' => 'A', 'department' => 'CS', 'batch_id' => 2014, 'batch_name' => 4],
        	['name' => 'B', 'department' => 'CS', 'batch_id' => 2014, 'batch_name' => 4],
        	['name' => 'C', 'department' => 'CS', 'batch_id' => 2014, 'batch_name' => 4],

        	['name' => 'A', 'department' => 'CS', 'batch_id' => 2015, 'batch_name' => 5],
        	['name' => 'B', 'department' => 'CS', 'batch_id' => 2015, 'batch_name' => 5],
        	['name' => 'C', 'department' => 'CS', 'batch_id' => 2015, 'batch_name' => 5],

        	['name' => 'A', 'department' => 'CS', 'batch_id' => 2016, 'batch_name' => 6],
        	['name' => 'B', 'department' => 'CS', 'batch_id' => 2016, 'batch_name' => 6],
        	['name' => 'C', 'department' => 'CS', 'batch_id' => 2016, 'batch_name' => 6],

        	['name' => 'A', 'department' => 'CS', 'batch_id' => 2017, 'batch_name' => 7],
        	['name' => 'B', 'department' => 'CS', 'batch_id' => 2017, 'batch_name' => 7],
        	['name' => 'C', 'department' => 'CS', 'batch_id' => 2017, 'batch_name' => 7]
        ]);
    }
}
