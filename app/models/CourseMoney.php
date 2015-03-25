<?php

class CourseMoney extends Eloquent {

	protected $table = 'course_money';
	public static function insert($cost,$course_id,$semester,$year){
		$course_money 				= new CourseMoney();
		$course_money->cost_balance = $cost;
		$course_money->course_id 	= $course_id;
		$course_money->semester 	= $semester;
		$course_money->years		= $year;
		$course_money->save();
		return $course_money->id;
	}

	public static function get($course_id,$semester,$year){
		$data = CourseMoney::where('course_id',$course_id)
								->where('semester',$semester)
								->where('years',$year)
								->get();
		if(count($data)<=0)
			return 0;
		return $data[0]->cost_balance;
	}

	public function _update($cost){	
		$this->cost_balance = $cost;
		$this->save();
		return $this->id;
	}

}
