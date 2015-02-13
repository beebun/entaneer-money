<?php

class ReportController extends BaseController {

	public function getSemester($semester,$year){
		$type = Auth::user()->type;
		if($type==1)
		{
			$arr['semester']     = $semester;
			$arr['year']         = $year;
			$arr['income_types'] = IncomeType::all();
			$arr['departments']  = department::all();
			// echo "<pre>";
				
			$table       = array();
			$course_name = array();

			$courses     = course::all();
			$k           = 0 ;
				
			foreach($courses as $course){
				$temp       = array();
				$is_null    = true ;
				$department = 0 ;

				for($i=1;$i<=6;$i++){
					$income_type = $i ;
					$data = DB::select("SELECT course, department, sum(amount) as result
										FROM item  
										WHERE income_type ='".$income_type."' 
											and course='".$course->id."' 
											and semester='".$semester."'
											and year='".$year."'
										");

					if( !is_null($data[0]->result) ) {
						$is_null    = false ;
						$temp[$i-1] = $data[0]->result;
						$department = $data[0]->department;
					}
					else $temp[$i-1] = 0 ;
				}

				if( !$is_null ) {
					$course_name[$k][0] = $course->name ;
					$course_name[$k][1] = $department ;
					$table[$k] = $temp ;
					$k++;
				}
			}



			$course_name2 = array();
			$table2       = array();
			$k            = 0 ;

			for($i=count($courses)-4;$i<count($courses);$i++){

					//Department from 0 (ENG) => 8
				for($dep=0;$dep<=8;$dep++){
					$temp       = array(0,0,0,0,0,0,0,0,0);
					$department = 0 ;
					$is_null    = true ;
						//Income Type 
					for($j=7;$j<=9;$j++){

						$income_type = $j ;

						$data = DB::select("SELECT  course, department, sum(amount) as result
											FROM item  
											WHERE income_type ='".$income_type."' 
												and course='".$courses[$i]->id."' 
												and semester='".$semester."'
												and year='".$year."'
												and department = '".$dep."'
											");

						if( !is_null($data[0]->result) ) {
							$is_null    = false ;
							$temp[$j-1] = $data[0]->result;
						}
						else $temp[$j-1] = 0 ;
					}

					if( !$is_null ) {
						$course_name2[$k][0] = $courses[$i]->name ;
						$course_name2[$k][1] = $dep ;
						$table2[$k] = $temp ;
						$k++;
					}
				}
			}




			$course_name3 = array();
			$table3       = array();
			$k            = 0 ;

			for($i=61;$i<=62;$i++){
						
				$course_id = $i ;

				//Department from 0 (ENG) => 8
				for($dep=0;$dep<=8;$dep++){
					$temp        = array(0,0,0,0,0,0,0,0,0);
					$department  = 0 ;
					$is_null     = true ;
					$income_type = 1 ;

					$data = DB::select("SELECT  course, department, sum(amount) as result
										FROM item  
										WHERE income_type ='".$income_type."' 
											and course='".$course_id."' 
											and semester='".$semester."'
											and year='".$year."'
											and department = '".$dep."'
										");

					if( !is_null($data[0]->result) ) {
						$is_null = false ;
						$temp    = $data[0]->result;
					}
					else $temp = 0 ;

					if( !$is_null ) {
						$course_name3[$k][0] = $courses[$course_id-1]->name ;
						$course_name3[$k][1] = $dep ;
						$table3[$k]          = $temp ;
						$k++;
					}
				}
			}

				// die();

			$arr['table3']       = $table3;
			$arr['course_name3'] = $course_name3;

			$arr['table2']       = $table2;
			$arr['course_name2'] = $course_name2;

			$arr['table']        = $table ;
			$arr['course_name']  = $course_name ;


			return View::make('report')->with('arr', $arr);
		}
		else
		{
			$arr['semester']     = $semester;
			$arr['year']         = $year;
			$arr['income_types'] = IncomeType::all();
			$arr['departments']  = department::all();
			// echo "<pre>";
				
			$table       = array();
			$course_name = array();

			$courses     = course::all();
			$k           = 0 ;
				
			foreach($courses as $course){
				$temp       = array();
				$is_null    = true ;
				$department = 0 ;

				for($i=1;$i<=6;$i++){
					$income_type = $i ;
					$data = DB::select("SELECT course, department, sum(amount) as result
										FROM item  
										WHERE income_type ='".$income_type."' 
											and course='".$course->id."' 
											and semester='".$semester."'
											and year='".$year."'
											and department='".($type-1)."'
										");

					if( !is_null($data[0]->result) ) {
						$is_null    = false ;
						$temp[$i-1] = $data[0]->result;
						$department = $data[0]->department;
					}
					else $temp[$i-1] = 0 ;
				}

				if( !$is_null ) {
					$course_name[$k][0] = $course->name ;
					$course_name[$k][1] = $department ;
					$table[$k] = $temp ;
					$k++;
				}
			}



			$course_name2 = array();
			$table2       = array();
			$k            = 0 ;

			for($i=count($courses)-4;$i<count($courses);$i++){

					//Department from 0 (ENG) => 8

					$temp       = array(0,0,0,0,0,0,0,0,0);
					$department = 0 ;
					$is_null    = true ;
						//Income Type 
					for($j=7;$j<=9;$j++){

						$income_type = $j ;

						$data = DB::select("SELECT  course, department, sum(amount) as result
											FROM item  
											WHERE income_type ='".$income_type."' 
												and course='".$courses[$i]->id."' 
												and semester='".$semester."'
												and year='".$year."'
											and department='".($type-1)."'
											");

						if( !is_null($data[0]->result) ) {
							$is_null    = false ;
							$temp[$j-1] = $data[0]->result;
						}
						else $temp[$j-1] = 0 ;
					}

					if( !$is_null ) {
						$course_name2[$k][0] = $courses[$i]->name ;
						$course_name2[$k][1] = ($type-1) ;
						$table2[$k] = $temp ;
						$k++;
					}
				
			}




			$course_name3 = array();
			$table3       = array();
			$k            = 0 ;

			for($i=61;$i<=62;$i++){
						
				$course_id = $i ;

				//Department from 0 (ENG) => 8

					$temp        = array(0,0,0,0,0,0,0,0,0);
					$department  = 0 ;
					$is_null     = true ;
					$income_type = 1 ;

					$data = DB::select("SELECT  course, department, sum(amount) as result
										FROM item  
										WHERE income_type ='".$income_type."' 
											and course='".$course_id."' 
											and semester='".$semester."'
											and year='".$year."'
											and department='".($type-1)."'
										");

					if( !is_null($data[0]->result) ) {
						$is_null = false ;
						$temp    = $data[0]->result;
					}
					else $temp = 0 ;

					if( !$is_null ) {
						$course_name3[$k][0] = $courses[$course_id-1]->name ;
						$course_name3[$k][1] = ($type-1) ;
						$table3[$k]          = $temp ;
						$k++;
					}
				
			}

				// die();

			$arr['table3']       = $table3;
			$arr['course_name3'] = $course_name3;

			$arr['table2']       = $table2;
			$arr['course_name2'] = $course_name2;

			$arr['table']        = $table ;
			$arr['course_name']  = $course_name ;


			return View::make('report')->with('arr', $arr);
		}
	}

	public function getYear($year){
		$type = Auth::user()->type;
		if($type==1)
		{
			$arr['year']        = $year;
			$arr['departments'] = department::all();
			
			foreach($arr['departments'] as $each){

				$temp           = expenditure1::where('department', $each->id)->where('year', $year)->first();

				if($temp['amount'] == "")
					$val[$each->id] = 0;
				else
					$val[$each->id] = $temp['amount'];
			}

			foreach($arr['departments'] as $each){

				$sum = DB::select("SELECT sum(amount) as sum from expenditure2 where year='".$year."' and department ='".$each->id."'");

				if( is_null($sum[0]->sum) )
					$val2[$each->id] = 0;
				else
					$val2[$each->id] = $sum[0]->sum;
			}

			$arr['val']  = $val ;
			$arr['val2'] = $val2;

			return View::make('report-year')->with('arr', $arr);
		}
		else
		{
			$arr['year']        = $year;
			$arr['departments'] = department::all();
			
				$temp	= expenditure1::where('department', ($type-1))->where('year', $year)->first();

				if($temp['amount'] == "")
					$val[($type-1)] = 0;
				else
					$val[($type-1)] = $temp['amount'];
			



				$sum = DB::select("SELECT sum(amount) as sum from expenditure2 where year='".$year."' and department ='".($type-1)."'");

				if( is_null($sum[0]->sum) )
					$val2[($type-1)] = 0;
				else
					$val2[($type-1)] = $sum[0]->sum;
			

			$arr['val']  = $val ;
			$arr['val2'] = $val2;

			return View::make('report-year')->with('arr', $arr);
		}

	}


	

}
