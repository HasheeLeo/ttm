<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
        	['code' => 'CS490', 'name' => 'Advanced Topics in Computing', 'credit' => 2],
        	['code' => 'CS481', 'name' => 'Computer Forensics', 'credit' => 3],
        	['code' => 'HU103', 'name' => 'Principles of Sociology', 'credit' => 3],

        	['code' => 'EE433', 'name' => 'Digital Image Processing', 'credit' => 3],
        	['code' => 'MATH333', 'name' => 'Numerical Analysis', 'credit' => 3],
        	['code' => 'FIN100', 'name' => 'Principles of Accounting', 'credit' => 3],
        	['code' => 'HU222', 'name' => 'Professional Ethics', 'credit' => 2],
        	['code' => 'HU102', 'name' => 'Psychology', 'credit' => 3],
        	['code' => 'CS352', 'name' => 'Theory of Automata & FL', 'credit' => 3],

        	['code' => 'EE321', 'name' => 'Computer Architecture & Organization', 'credit' => 3],
        	['code' => 'CS251', 'name' => 'Design & Analysis of Algorithms', 'credit' => 3],
        	['code' => 'CS260', 'name' => 'Human Computer Interaction', 'credit' => 3],
        	['code' => 'MATH361', 'name' => 'Probability and Statistics', 'credit' => 3],
        	['code' => 'CS344', 'name' => 'Web Engineering', 'credit' => 3],

        	['code' => 'PHY101', 'name' => 'Applied Physics', 'credit' => 3],
        	['code' => 'MATH112', 'name' => 'Calculus II', 'credit' => 3],
        	['code' => 'EE221', 'name' => 'Digital Logic Design', 'credit' => 3],
        	['code' => 'MGT164', 'name' => 'Introduction to Management', 'credit' => 2],
        	['code' => 'CS212', 'name' => 'Object Oriented Programming', 'credit' => 3],
        	['code' => 'HU107', 'name' => 'Pakistan Studies', 'credit' => 2]
        ]);
    }
}
