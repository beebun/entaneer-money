<?php
class DepartmentTotal extends Eloquent {
	protected $table = 'department_total';
	public static function insert($cost,$dept_id,$semester,$year){
		$department_total 					= new DepartmentTotal();
		$department_total->cost_balance 	= $cost;
		$department_total->department_id 	= $dept_id;
		$department_total->semester 		= $semester;
		$department_total->years			= $year;
		$department_total->save();
		return $department_total->id;
	}

	public static function get($dept_id,$semester,$year){
		$department_total = DepartmentTotal::where('department_id',$dept_id)
											->where('semester',$semester)
											->where('years',$year)
											->get();
		return $department_total;
	}

	public function _update($cost){	
		$this->cost_balance = $cost;
		$this->save();
		return $this->id;
	}

	public static function getByYear($year,$dept_id){
		$data = DB::select("SELECT sum(cost_balance) as sum 
									  from department_total 
									  where (years='".($year-1)."' and semester='2')
									  OR (years='".($year-1)."' and semester='3')
									  OR (years='".($year)."' and semester='1')
									  and department_id ='".$dept_id."'");
		return $data;
	}

}
