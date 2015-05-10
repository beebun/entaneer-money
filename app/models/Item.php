<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Item extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'item';
	
	//protected $fillable = array('course', 'income_type', 'department', 'semester', 'year', 'amount', 'detail');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static function getTable1Row($income_type,$course_id,$semester,$year,$type){
		$query = "SELECT course, department, sum(amount) as result
										FROM item  
										WHERE income_type ='".$income_type."' 
											and course='".$course_id."' 
											and course != 61 
											and course != 62
											and semester='".$semester."'
											and year='".$year."' ";

		if($type!=1)
			$query .= "and department='".($type-1)."'";
					
		$data = DB::select($query);
		return $data;
	}

	public static function getTable2Row(){
		
	}

	public static function getTable3Row(){
		
	}

}
