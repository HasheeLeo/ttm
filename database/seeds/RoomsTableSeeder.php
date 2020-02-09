<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            ['name' => 'CR-01', 'location' => 'SEECS'],
            ['name' => 'CR-02', 'location' => 'SEECS'],
            ['name' => 'CR-03', 'location' => 'SEECS'],
            ['name' => 'CR-04', 'location' => 'SEECS'],
            ['name' => 'CR-05', 'location' => 'SEECS'],
            ['name' => 'CR-06', 'location' => 'SEECS'],
            ['name' => 'CR-07', 'location' => 'SEECS'],
            ['name' => 'CR-08', 'location' => 'SEECS'],
            ['name' => 'CR-09', 'location' => 'SEECS'],
            ['name' => 'CR-10', 'location' => 'SEECS'],
            ['name' => 'CR-11', 'location' => 'SEECS'],
            ['name' => 'CR-12', 'location' => 'SEECS'],
            ['name' => 'CR-13', 'location' => 'SEECS'],
            ['name' => 'CR-14', 'location' => 'SEECS'],
            ['name' => 'CR-15', 'location' => 'SEECS'],
            ['name' => 'CR-16', 'location' => 'IAEC'],
            ['name' => 'CR-17', 'location' => 'IAEC'],
            ['name' => 'CR-18', 'location' => 'IAEC'],
            ['name' => 'CR-19', 'location' => 'IAEC'],
            ['name' => 'CR-20', 'location' => 'IAEC'],
            ['name' => 'Lecture Hall', 'location' => 'IAEC'],
            ['name' => 'CR-21', 'location' => 'RIMMS'],
            ['name' => 'CR-22', 'location' => 'RIMMS'],

            ['name' => 'Computing Lab I', 'location' => 'SEECS'],
            ['name' => 'Computing Lab II', 'location' => 'SEECS'],
            ['name' => 'Computing Lab III', 'location' => 'SEECS'],
            ['name' => 'Computing Lab IV', 'location' => 'SEECS'],
            ['name' => 'Computing Lab V', 'location' => 'SEECS'],
            ['name' => 'IBM Lab', 'location' => 'SEECS'],
            ['name' => 'Digital Embedded Lab', 'location' => 'SEECS'],
            ['name' => 'DSP & Comm Lab', 'location' => 'SEECS'],
            ['name' => 'Control System Lab', 'location' => 'SEECS'],
            ['name' => 'EMS Lab', 'location' => 'SEECS'],
            ['name' => 'Basic Electronics Lab', 'location' => 'SEECS'],
            ['name' => 'Advance Electronics Lab', 'location' => 'IAEC'],
            ['name' => 'MDA Lab', 'location' => 'RIMMS']
        ]);
    }
}
