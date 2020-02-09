<?php

use Illuminate\Database\Seeder;

class FacultiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculties')->insert([
        	['name' => 'Dr. Omer Arif'],
        	['name' => 'Ms. Haleema Zia'],
        	['name' => 'Dr. Shahzad Saleem'],
        	['name' => 'Ms. Yusra Mushtaq'],
        	['name' => 'Mr. Abdul Rauf Iqbal'],
        	['name' => 'Dr. Muhammad Muneebullah'],
        	['name' => 'Dr. Asad Ali Shah'],

        	['name' => 'Dr. Muhammad Imran Malik'],
        	['name' => 'Dr. Anis Ur Rehman'],
        	['name' => 'Dr. Ibrar Hussain'],
        	['name' => 'Ms. Atifa Kanwal'],
        	['name' => 'Mr. Mustansar Mahmood'],
        	['name' => 'Mr. Anwar Mughees Alam'],
        	['name' => 'Dr. A R Baluch'],
        	['name' => 'Ms. Saleha Tabassum'],
        	['name' => 'Ms. Nayab Chaudhary'],
        	['name' => 'Dr. Safdar Abbas'],
        	['name' => 'Ms. Tayyaba Zaheer'],

        	['name' => 'Mr. Nasir Mahmood'],
        	['name' => 'Mr. Muhammad Imran Abeel'],
        	['name' => 'Ms. Sana Khalique'],
        	['name' => 'Dr. Mian M Hamayun'],
        	['name' => 'Dr. Mehdi Hussain'],
        	['name' => 'Dr. Hassan Tahir'],
        	['name' => 'Dr. Adnan Aslam'],
        	['name' => 'Dr. Qaiser Riaz'],

        	['name' => 'Dr. Imran Malik'],
        	['name' => 'Dr. Hina Munir Dutt'],
        	['name' => 'Mr. Habeel Ahmed'],
        	['name' => 'Mr. Arshad Nazir'],
        	['name' => 'Dr. Muhammad Umar Khan'],
        	['name' => 'Mr. Talha Aleem Khwaja'],
        	['name' => 'Ms. Hania Aslam'],
        	['name' => 'Dr. Asad Waqar Malik'],
        	['name' => 'Mr. Hussain Abbas'],

        	['name' => 'Mr. Ehsanullah Zafar'],
        	['name' => 'Mr. Ahsan Gul']
        ]);
    }
}
