<?php

class PercentTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
    {
        DB::table('percent')->delete();

        for($i= 2552 ;$i<2559;$i++){
        	Percent::create(
        	['department_percent' => 0,
        	 'input_type'=>'1',
        	 'faculty_percent'=>100,
        	 'name'=>'ค่าหน่วยกิต',
        	 'year'=>$i]);

        Percent::create(
        	['department_percent' => 0,
        	 'input_type'=>'3',
        	 'faculty_percent'=>100,
        	 'name'=>'ค่าธรรมเนียม',
        	 'year'=>$i]);

        Percent::create(
        	['department_percent' => 0,
        	 'input_type'=>'6',
        	 'faculty_percent'=>100,
        	 'name'=>'ค่ารักษาสภาพ',
        	 'year'=>$i]);

        Percent::create(
        	['department_percent' => 0,
        	 'input_type'=>'7',
        	 'faculty_percent'=>100,
        	 'name'=>'Service',
        	 'year'=>$i]);

        Percent::create(
        	['department_percent' => 0,
        	 'input_type'=>'8',
        	 'faculty_percent'=>100,
        	 'name'=>'OH',
        	 'year'=>$i]);

        Percent::create(
        	['department_percent' => 0,
        	 'input_type'=>'9',
        	 'faculty_percent'=>100,
        	 'name'=>'ค่าบริจาค',
        	 'year'=>$i]);

        Percent::create(
        	['department_percent' => 0,
        	 'input_type'=>null,
        	 'faculty_percent'=>100,
        	 'name'=>'ค่าสอน อื่น ๆ',
        	 'year'=>$i]);
        }

        



       

    }

}