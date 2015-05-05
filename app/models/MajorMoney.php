<?php


class MajorMoney extends Eloquent {

	protected $table = 'major_money';
	public static function insert($cost_balance,$dept_id,$year){
		$major_money = new MajorMoney();
		$major_money->cost_balance = $cost_balance;
		$major_money->department_id = $dept_id;
		$major_money->years 	   = $year;
		$major_money->save();
		return $major_money->id;
	}

	public function _update($cost_balance){
		$this->cost_balance = $cost_balance;
		$this->save();
		return $this->id;
	}

	public static function getByYear($dept_id,$year){
		$data = MajorMoney::where('department_id',$dept_id)
							->where('years',$year)
							->get();
		return $data;
	}



}
