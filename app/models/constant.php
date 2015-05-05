<?php


class Constant extends Eloquent{

	protected $table = 'constant';
	public static function getTotalSCCH($course_id,$semester,$year){
		$data = DB::select("SELECT sum(scch_value) as scch,sum(student_amount) as student
							FROM constant  
							WHERE course='".$course_id."' 
								and semester='".$semester."'
								and year='".$year."'
							");
		if(!is_null($data[0]->student))
			return $data[0]->student;
		return 0; 
	}

	public static function getTotalSCCHObj($course_id,$semester,$year){
		$data = DB::select("SELECT sum(scch_value) as scch,sum(student_amount) as student
							FROM constant  
							WHERE course='".$course_id."' 
								and semester='".$semester."'
								and year='".$year."'
							");
		return $data;
	}

	public static function getEntAllSCCH($course_id,$semester,$year){
		$data = DB::select("SELECT sum(scch_value) as scch,sum(student_amount) as student
							FROM constant  
							WHERE department_c >7 AND department_c <16
								and course='".$course_id."' 
								and semester='".$semester."'
								and year='".$year."'
							"); 
		return $data; 
	}

	public static function getByDepartment($dept_id,$course_id,$semester,$year){
		$data = DB::select("SELECT scch_value,student_amount
							FROM constant  
							WHERE department_c ='".$dept_id."' 
								and course='".$course_id."' 
								and semester='".$semester."'
								and year='".$year."'
							");
		if(count($data)<=0)
			return 0;
		return $data[0]->student_amount; 
	}

}
