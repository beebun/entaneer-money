<?php

class ReportController extends BaseController {

	public static $CREDIT_FEE_ID; //ค่าหน่วยกิต
	public static $JOINING_FEE_ID; //ค่าแรกเข้า
	public static $FEE_ID; //ค่าธรรมเนียม
	public static $LIB_FEE_ID; //ค่าห้องสมุด
	public static $OPERATING_COST_ID; //ค่าดำเนินการ
	public static $MATAINING_FEE_ID; //ค่ารักษาสภาพ
	public static $SERVICE_ID;
	public static $OH_ID;
	public static $DONATE_ID;

	public function __construct()
	{
		$this->path = URL::to(Config::get('route.Order'));
		self::$CREDIT_FEE_ID = IncomeType::where('name','ค่าหน่วยกิต')->first()->id;
		self::$JOINING_FEE_ID = IncomeType::where('name','ค่าแรกเข้า')->first()->id;
		self::$FEE_ID = IncomeType::where('name','ค่าธรรมเนียม')->first()->id;
		self::$LIB_FEE_ID = IncomeType::where('name','ค่าห้องสมุด')->first()->id;
		self::$OPERATING_COST_ID = IncomeType::where('name','ค่าดำเนินการ')->first()->id;
		self::$MATAINING_FEE_ID = IncomeType::where('name','ค่ารักษาสภาพ')->first()->id;
		self::$SERVICE_ID = IncomeType::where('name','Service')->first()->id;
		self::$OH_ID = IncomeType::where('name','OH')->first()->id;
		self::$DONATE_ID = IncomeType::where('name','บริจาค')->first()->id;
		$this->tempDir = public_path('tempUploads');
		$this->uploadDir = public_path('uploads');

	} 

	public function getSemester($semester,$year){
		$type = Auth::user()->type;
		if($type==1)
		{
			$arr['semester']     = $semester;
			$arr['year']         = $year;
			$arr['income_types'] = IncomeType::all();
			$arr['departments']  = department::all();
			$departments 		 = $arr['departments'] ;
			$percents 			 = Percent::all();
			$percent 			 = array();
			foreach($percents as $each){
				$percent[$each->input_type] = $each;
			}
			// echo "<pre>";
				
			$table       = array();
			$course_name = array();

			$courses     = course::all();
			$k           = 0 ;
				
			foreach($courses as $course){
				$temp       = array();
				$is_null    = true ;
				$department = 0;
				$total		= 0;

				for($i=1;$i<=7;$i++){
					$income_type = $i ;
					if($i==7){
						$income_type = 10;
					}
					$data = DB::select("SELECT course, department, sum(amount) as result
										FROM item  
										WHERE income_type ='".$income_type."' 
											and course='".$course->id."' 
											and course != 61 
											and course != 62
											and semester='".$semester."'
											and year='".$year."'
										");

					if( !is_null($data[0]->result) ) {
						$is_null    = false ;
						$temp[$i-1] = $data[0]->result;
						$department = $data[0]->department;
					}
					else $temp[$i-1] = 0 ;

					if($i<7){
						$total 	+=	$temp[$i-1];
					}else{
						$total 	-=	$temp[$i-1];
					}
					
				}


				if( !$is_null ) {
					$course_name[$k][0] = $course->name ;
					$course_name[$k][1] = $department ;

					$i--;

					$temp[$i++]  = $total;
					//fund = total*0.05
					$temp[$i++] = $total*0.05;
					$fund_index = $i-1;
					

					//eng = sum of input_type*percent *0.95 except lib(id=4)
					$temp[$i++] = round((($temp[self::$CREDIT_FEE_ID-1]*$percent[self::$CREDIT_FEE_ID]->faculty_percent/100)+
									  $temp[self::$JOINING_FEE_ID-1]+
									  ($temp[self::$FEE_ID-1]*$percent[self::$FEE_ID]->faculty_percent/100)+
									  $temp[self::$OPERATING_COST_ID-1]+
									  $temp[self::$MATAINING_FEE_ID-1])*0.95,2);
					$eng_index = $i-1;
					

					//lib = 0.95*lib value
					$temp[$i++] = $temp[self::$LIB_FEE_ID-1]*0.95;
					$lib_index = $i-1;
					

					//dept = sum of credit_price*percent,fee*percent then multiply by 0.95
					$temp[$i++] = (($temp[self::$CREDIT_FEE_ID-1]*$percent[self::$CREDIT_FEE_ID]->department_percent/100)+
								   ($temp[self::$FEE_ID-1]*$percent[self::$FEE_ID]->department_percent/100))*0.95;
					$dept_index = $i-1;
					

					//total fund+lib+eng+dept
					$temp[$i] = 0;
					for($j=1;$j<5;$j++){
						$temp[$i] += $temp[$i-$j];
					}
					$i++;
					$start_index = $i;

					if($course->id>=54&&$course->id<=59){
						$ent_all_scch = 0;
						$data = DB::select("SELECT sum(scch_value) as scch,sum(student_amount) as student
											FROM constant  
											WHERE department_c >7 AND department_c <16
												and course='".$course->id."' 
												and semester='".$semester."'
												and year='".$year."'
											"); 
						if(count($data>0)){
							$ent_all_scch = $data[0]->scch;
						}

						for($j=1;$j<count($departments)-2;$j++){
							$data = DB::select("SELECT scch_value,student_amount
												FROM constant  
												WHERE department_c ='".$departments[$j]->id."' 
													and course='".$course->id."' 
													and semester='".$semester."'
													and year='".$year."'
												"); 
							if(count($data)>0){
								if($ent_all_scch>0){
									$temp[$i++] = round($temp[$dept_index]*$data[0]->scch_value/$ent_all_scch,2);
								}else{
									$temp[$i++] = 0;
								}
								
							}
							else{
								$temp[$i++] = 0;
							}
							
						}
						//BME
						$temp[$i++] = 0;
						
					}else{
						for($j=1;$j<count($departments)-2;$j++){
							if($department == $departments[$j]->id){
								$temp[$i++] = $temp[$dept_index];
								
							}else{
								$temp[$i++] = 0;
							}
							
							
						}
						//BME
						$temp[$i++] = 0;
						
					}
					//54 = ค่าหน่วยกิตป ตรี , 58 = ป.ตรี ภาคพิเศษ (1)
					if($course->id ==54||$course->id == 58){
						$total_scch = 0;
						$data = DB::select("SELECT sum(scch_value) as scch,sum(student_amount) as student
											FROM constant  
											WHERE course='".$course->id."' 
												and semester='".$semester."'
												and year='".$year."'
											"); 
						if(count($data>0)){
							$total_scch = $data[0]->scch;
						}
						if($total_scch>0){
							$temp[$i++] = round($temp[$eng_index]+$temp[$dept_index]*$ent_all_scch/$total_scch,2);
						}else{
							$temp[$i++] = 0;
						}
						
					}else{
						$temp[$i++] = $temp[$eng_index];
					}
					
					
					$temp[$i++] = $temp[$fund_index];
					
					$temp[$i++] = $temp[$lib_index];

					$temp[$i] = 0;
					for($j=$start_index;$j<$i;$j++){
						$temp[$i] += $temp[$j];
					}

					
					$table[$k] = $temp ;
					$k++;
				}
			}

			// echo '<pre>';
			// var_dump($table);
			// echo '</pre>';
			// die();

			$course_name2 = array();
			$table2       = array();
			$k            = 0 ;

			for($i=count($courses)-4;$i<count($courses);$i++){

					//Department from 0 (ENG) => 8
				for($dep=0;$dep<=8;$dep++){
					$temp       = array(0,0,0,0,0,0,0,0,0);
					$department = 0 ;
					$is_null    = true ;
					$total 		= 0;
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

						$total 	+=	$temp[$j-1];
					}

					if( !$is_null ) {
						$course_name2[$k][0] = $courses[$i]->name ;
						$course_name2[$k][1] = $dep ;
						$j--;
						$temp[$j++]  = $total;
						//fund = total*0.05
						$temp[$j++] = $total*0.05;
						$fund_index = $j-1;
						

						//eng = sum of input_type(Service,OH,donate)*faculty_percent *0.95 
						$temp[$j++] = round(($temp[self::$SERVICE_ID-1]*$percent[self::$SERVICE_ID]->faculty_percent/100)+
										  	 ($temp[self::$OH_ID-1]*$percent[self::$OH_ID]->faculty_percent/100)+
										  	 ($temp[self::$DONATE_ID-1]*$percent[self::$DONATE_ID]->faculty_percent/100)*0.95,2);
						$eng_index = $j-1;
						

						//lib = 0.95*lib value
						$temp[$j++] = $temp[self::$LIB_FEE_ID-1]*0.95;
						$lib_index = $j-1;
						

						//dept = sum of input_type(Service,OH,donate)*dept_percent *0.95 
						$temp[$j++] = round(($temp[self::$SERVICE_ID-1]*$percent[self::$SERVICE_ID]->department_percent/100)+
										  	 ($temp[self::$OH_ID-1]*$percent[self::$OH_ID]->department_percent/100)+
										  	 ($temp[self::$DONATE_ID-1]*$percent[self::$DONATE_ID]->department_percent/100)*0.95,2);
						$dept_index = $j-1;
						

						//total fund+lib+eng+dept
						$temp[$j] = 0;
						for($l=1;$l<5;$l++){
							$temp[$j] += $temp[$j-$l];
						}
						$j++;
						//start index for calculate total
						$start_index = $j;

						for($l=1;$l<count($departments)-2;$l++){
							if($dep == $departments[$l]->id){
								$temp[$j++] = $temp[$dept_index];
								
							}else{
								$temp[$j++] = 0;
							}
							
							
						}
						//BME
						$temp[$j++] = 0;
									
						//ENG $dep 0 = Eng
						if($dep == 0){
							$temp[$j++] = $temp[$eng_index];
						}else{
							$temp[$j++] = $temp[$eng_index]+$temp[$dept_index];
						}
						
						//Fund
						$temp[$j++] = $temp[$fund_index];
						
						//Lib
						$temp[$j++] = $temp[$lib_index];

						//total
						$temp[$j] = 0;
						for($l=$start_index;$l<$j;$l++){
							$temp[$j] += $temp[$l];
						}
						
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

					for($j=1;$j<=2;$j++){
						if($j==2){ $income_type = 10;}
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
							$temp[$j-1]    = $data[0]->result;
						}
						else $temp[$j-1] = 0 ;
					}

					if( !$is_null ) {
						$course_name3[$k][0] = $courses[$course_id-1]->name ;
						$course_name3[$k][1] = $dep ;
						$total = $temp[0]-$temp[1];
						$j--;

						$temp[$j++]  = $total;
						//fund = total*0.05
						$temp[$j++] = $total*0.05;
						$fund_index = $j-1;

						//eng = sum of input_type(Service,OH,donate)*faculty_percent *0.95 
						$temp[$j++] = round(($temp[self::$CREDIT_FEE_ID-1]*$percent[self::$CREDIT_FEE_ID]->faculty_percent/100)*0.95,2);
						$eng_index = $j-1;
						

						//lib = 0.95*lib value
						$temp[$j++] = $temp[self::$LIB_FEE_ID-1]*0.95;
						$lib_index = $j-1;
						

						//dept = sum of input_type(Service,OH,donate)*dept_percent *0.95 
						$temp[$j++] = round(($temp[self::$CREDIT_FEE_ID-1]*$percent[self::$CREDIT_FEE_ID]->department_percent/100)*0.95,2);
						$dept_index = $j-1;
						

						//total fund+lib+eng+dept
						$temp[$j] = 0;
						for($l=1;$l<5;$l++){
							$temp[$j] += $temp[$j-$l];
						}
						$j++;
						//start index for calculate total
						$start_index = $j;

						for($l=1;$l<count($departments)-2;$l++){
							if($dep == $departments[$l]->id){
								$temp[$j++] = $temp[$dept_index];
								
							}else{
								$temp[$j++] = 0;
							}
							
							
						}
						//BME
						$temp[$j++] = 0;
									
						//ENG $dep 0 = Eng
						if($dep == 0){
							$temp[$j++] = $temp[$eng_index];
						}else{
							$temp[$j++] = $temp[$eng_index]+$temp[$dept_index];
						}
						
						//Fund
						$temp[$j++] = $temp[$fund_index];
						
						//Lib
						$temp[$j++] = $temp[$lib_index];

						//total
						$temp[$j] = 0;
						for($l=$start_index;$l<$j;$l++){
							$temp[$j] += $temp[$l];
						}
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
