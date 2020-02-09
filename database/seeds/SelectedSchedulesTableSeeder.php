<?php

use Illuminate\Database\Seeder;

class SelectedSchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('selected_schedules')->insert(['schedule_id' => 123]);
    }
}
