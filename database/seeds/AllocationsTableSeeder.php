<?php

use Illuminate\Database\Seeder;

class AllocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('allocations')->insert([
        	['course_code' => 'CS490', 'faculty_id' => 1, 'section_id' => 25],
        	['course_code' => 'CS481', 'faculty_id' => 2, 'section_id' => 25],
        	['course_code' => 'HU103', 'faculty_id' => 4, 'section_id' => 25],
        	
        	['course_code' => 'CS490', 'faculty_id' => 1, 'section_id' => 26],
        	['course_code' => 'CS481', 'faculty_id' => 3, 'section_id' => 26],
        	['course_code' => 'HU103', 'faculty_id' => 4, 'section_id' => 26],

        	['course_code' => 'CS490', 'faculty_id' => 1, 'section_id' => 27],
        	['course_code' => 'CS481', 'faculty_id' => 3, 'section_id' => 27],
        	['course_code' => 'HU103', 'faculty_id' => 5, 'section_id' => 27],

        	['course_code' => 'EE433', 'faculty_id' => 8, 'section_id' => 28],
        	['course_code' => 'MATH333', 'faculty_id' => 10, 'section_id' => 28],
        	['course_code' => 'FIN100', 'faculty_id' => 12, 'section_id' => 28],
        	['course_code' => 'HU222', 'faculty_id' => 14, 'section_id' => 28],
        	['course_code' => 'HU102', 'faculty_id' => 15, 'section_id' => 28],
        	['course_code' => 'CS352', 'faculty_id' => 17, 'section_id' => 28],

        	['course_code' => 'EE433', 'faculty_id' => 8, 'section_id' => 29],
        	['course_code' => 'MATH333', 'faculty_id' => 10, 'section_id' => 29],
        	['course_code' => 'FIN100', 'faculty_id' => 12, 'section_id' => 29],
        	['course_code' => 'HU222', 'faculty_id' => 14, 'section_id' => 29],
        	['course_code' => 'HU102', 'faculty_id' => 15, 'section_id' => 29],
        	['course_code' => 'CS352', 'faculty_id' => 17, 'section_id' => 29],

        	['course_code' => 'EE433', 'faculty_id' => 9, 'section_id' => 30],
        	['course_code' => 'MATH333', 'faculty_id' => 11, 'section_id' => 30],
        	['course_code' => 'FIN100', 'faculty_id' => 13, 'section_id' => 30],
        	['course_code' => 'HU222', 'faculty_id' => 14, 'section_id' => 30],
        	['course_code' => 'HU102', 'faculty_id' => 16, 'section_id' => 30],
        	['course_code' => 'CS352', 'faculty_id' => 18, 'section_id' => 30],

        	['course_code' => 'EE321', 'faculty_id' => 19, 'section_id' => 31],
        	['course_code' => 'CS251', 'faculty_id' => 21, 'section_id' => 31],
        	['course_code' => 'CS260', 'faculty_id' => 23, 'section_id' => 31],
        	['course_code' => 'MATH361', 'faculty_id' => 25, 'section_id' => 31],
        	['course_code' => 'CS344', 'faculty_id' => 26, 'section_id' => 31],

        	['course_code' => 'EE321', 'faculty_id' => 19, 'section_id' => 32],
        	['course_code' => 'CS251', 'faculty_id' => 21, 'section_id' => 32],
        	['course_code' => 'CS260', 'faculty_id' => 23, 'section_id' => 32],
        	['course_code' => 'MATH361', 'faculty_id' => 25, 'section_id' => 32],
        	['course_code' => 'CS344', 'faculty_id' => 26, 'section_id' => 32],

        	['course_code' => 'EE321', 'faculty_id' => 20, 'section_id' => 33],
        	['course_code' => 'CS251', 'faculty_id' => 22, 'section_id' => 33],
        	['course_code' => 'CS260', 'faculty_id' => 24, 'section_id' => 33],
        	['course_code' => 'MATH361', 'faculty_id' => 25, 'section_id' => 33],
        	['course_code' => 'CS344', 'faculty_id' => 7, 'section_id' => 33],

        	['course_code' => 'PHY101', 'faculty_id' => 27, 'section_id' => 34],
        	['course_code' => 'MATH112', 'faculty_id' => 28, 'section_id' => 34],
        	['course_code' => 'EE221', 'faculty_id' => 29, 'section_id' => 34],
        	['course_code' => 'MGT164', 'faculty_id' => 32, 'section_id' => 34],
        	['course_code' => 'CS212', 'faculty_id' => 33, 'section_id' => 34],
        	['course_code' => 'HU107', 'faculty_id' => 35, 'section_id' => 34],

        	['course_code' => 'PHY101', 'faculty_id' => 27, 'section_id' => 35],
        	['course_code' => 'MATH112', 'faculty_id' => 28, 'section_id' => 35],
        	['course_code' => 'EE221', 'faculty_id' => 30, 'section_id' => 35],
        	['course_code' => 'MGT164', 'faculty_id' => 32, 'section_id' => 35],
        	['course_code' => 'CS212', 'faculty_id' => 33, 'section_id' => 35],
        	['course_code' => 'HU107', 'faculty_id' => 35, 'section_id' => 35],

        	['course_code' => 'PHY101', 'faculty_id' => 27, 'section_id' => 36],
        	['course_code' => 'MATH112', 'faculty_id' => 28, 'section_id' => 36],
        	['course_code' => 'EE221', 'faculty_id' => 31, 'section_id' => 36],
        	['course_code' => 'MGT164', 'faculty_id' => 32, 'section_id' => 36],
        	['course_code' => 'CS212', 'faculty_id' => 34, 'section_id' => 36],
        	['course_code' => 'HU107', 'faculty_id' => 5, 'section_id' => 36],

        	['course_code' => 'EE321', 'faculty_id' => 36, 'section_id' => 31],
        	['course_code' => 'CS344', 'faculty_id' => 37, 'section_id' => 31],

        	['course_code' => 'EE321', 'faculty_id' => 36, 'section_id' => 32],
        	['course_code' => 'CS344', 'faculty_id' => 37, 'section_id' => 32],

        	['course_code' => 'EE321', 'faculty_id' => 36, 'section_id' => 33],
        	['course_code' => 'CS344', 'faculty_id' => 37, 'section_id' => 33]
        ]);
    }
}
