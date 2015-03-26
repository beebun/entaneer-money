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
		$this->path    		   		= URL::to(Config::get('route.Order'));
		
		self::$CREDIT_FEE_ID   		= IncomeType::where('name','ค่าหน่วยกิต')->first()->id;
		self::$JOINING_FEE_ID  		= IncomeType::where('name','ค่าแรกเข้า')->first()->id;	
		self::$FEE_ID 				= IncomeType::where('name','ค่าธรรมเนียม')->first()->id;
		self::$LIB_FEE_ID 			= IncomeType::where('name','ค่าห้องสมุด')->first()->id;
		self::$OPERATING_COST_ID 	= IncomeType::where('name','ค่าดำเนินการ')->first()->id;
		self::$MATAINING_FEE_ID 	= IncomeType::where('name','ค่ารักษาสภาพ')->first()->id;
		
		self::$SERVICE_ID 			= IncomeType::where('name','Service')->first()->id;
		self::$OH_ID 				= IncomeType::where('name','OH')->first()->id;
		self::$DONATE_ID 			= IncomeType::where('name','บริจาค')->first()->id;
		
		$this->tempDir 				= public_path('tempUploads');
		$this->uploadDir 			= public_path('uploads');

	} 

	public function getSemester($semester,$year){
		$type = Auth::user()->type;
		$total1_arr = array();
		$total2_arr = array();
		$total3_arr = array();

			$arr['semester']     = $semester;
			$arr['year']         = $year;
			$arr['income_types'] = IncomeType::all();
			$arr['departments']  = Department::all();
			$departments 		 = $arr['departments'] ;
			$percents 			 = Percent::all();
			$percent 			 = array();
			foreach($percents as $each){
				$percent[$each->input_type] = $each;
			}
			// echo "<pre>";
			
			$table       = array();
			$course_name = array();

			$courses     = Course::all();
			$k           = 0 ;
				
			foreach($courses as $course){
				$temp       = array_fill(0,27, 0);
				$is_null    = true ;
				$department = 0;
				$total		= 0;

				for($i=1;$i<=7;$i++){
					$income_type = $i ;
					if($i==7){
						$income_type = 10;
					}
					$query = "SELECT course, department, sum(amount) as result
										FROM item  
										WHERE income_type ='".$income_type."' 
											and course='".$course->id."' 
											and course != 61 
											and course != 62
											and semester='".$semester."'
											and year='".$year."' ";

					if($type!=1)
						$query .= "and department='".($type-1)."'";
					
					$data = DB::select($query);

					if( !is_null($data[0]->result) ) {
						$is_null    = false ;
						$temp[$income_type-1] = $data[0]->result;
						$department = $data[0]->department;
					}
					else $temp[$income_type-1] = 0 ;

					if($i<7){
						$total 	+=	$temp[$i-1];
					}else{
						$total 	-=	$temp[$i-1];
					}
					
				}


				if( !$is_null ) {
					$course_name[$k][0] = $course->name ;
					$course_name[$k][1] = $department ;

					//$i--;

					$temp[10]  = $total;
					//fund = total*0.05
					$temp[11] = $total*0.05;
					$fund_index = 11;
					

					//eng = sum of input_type*percent *0.95 except lib(id=4)
					$temp[12] = round((($temp[self::$CREDIT_FEE_ID-1]*$percent[self::$CREDIT_FEE_ID]->faculty_percent/100)+
									  $temp[self::$JOINING_FEE_ID-1]+
									  ($temp[self::$FEE_ID-1]*$percent[self::$FEE_ID]->faculty_percent/100)+
									  $temp[self::$OPERATING_COST_ID-1]+
									  $temp[self::$MATAINING_FEE_ID-1])*0.95,2);
					$eng_index = 12;
					

					//lib = 0.95*lib value
					$temp[13] = $temp[self::$LIB_FEE_ID-1]*0.95;
					$lib_index = 13;
					

					//dept = sum of credit_price*percent,fee*percent then multiply by 0.95
					$temp[14] = (($temp[self::$CREDIT_FEE_ID-1]*$percent[self::$CREDIT_FEE_ID]->department_percent/100)+
								   ($temp[self::$FEE_ID-1]*$percent[self::$FEE_ID]->department_percent/100))*0.95;
					$dept_index = 14;
					

					//total fund+lib+eng+dept
					$temp[15] = 0;
					for($j=11;$j<15;$j++){
						$temp[15] += $temp[$j];
					}
					//$i++;
					$start_index = 16;
					$i = $start_index;
					if($course->id>=54&&$course->id<=59){
						
						//query ent_all_scch
						$ent_all_scch = 0;
						$data = constant::getEntAllSCCH($course->id,$semester,$year);
						if(count($data>0)){
							$ent_all_scch = $data[0]->student;
						}

						//loop through each major
						
						for($j=1;$j<count($departments)-2;$j++){
							$data = constant::getByDepartment($departments[$j]->id,$course->id,$semester,$year);
							if(count($data)>0){
								if($ent_all_scch>0){
									$temp[$i++] = round($temp[$dept_index]*$data[0]->student_amount/$ent_all_scch,2);
								}else{
									$temp[$i++] = 0;
								}
								
							}
							else{
								$temp[$i++] = 0;
							}
							
						}
						//BME
						$temp[23] = 0;
						
					}else{
						for($j=1;$j<count($departments)-2;$j++){
							if($department == $departments[$j]->id){
								$temp[$i++] = $temp[$dept_index];
								
							}else{
								$temp[$i++] = 0;
							}
							
							
						}
						//BME
						$temp[23] = 0;
						
					}
					//54 = ค่าหน่วยกิตป ตรี , 58 = ป.ตรี ภาคพิเศษ (1)
					if($course->id ==54||$course->id == 58){
						$total_scch = 0;
						$data = constant::getTotalSCCH($course->id,$semester,$year);
						if(count($data>0)){
							$total_scch = $data[0]->student;
						}
						if($total_scch>0){
							$temp[24] = round($temp[$eng_index]+$temp[$dept_index]*$ent_all_scch/$total_scch,2);
						}else{
							$temp[24] = 0;
						}

						if($type == 1){
							if($course->id == 54 || ($course->id == 58 && $semester != 3)){
								$course_money = CourseMoney::getBySemester($semester,$year,$course->id);
								if(count($course_money)<=0){
									CourseMoney::insert($temp[$dept_index],$course->id,$semester,$year);
								}else{
									$course_money[0]->_update($temp[$dept_index]);
								}
							}
						}

						
					}else{
						$temp[24] = $temp[$eng_index];
					}
					
					
					$temp[25] = $temp[$fund_index];
					
					$temp[26] = $temp[$lib_index];

					$temp[27] = 0;
					for($j=$start_index;$j<27;$j++){
						$temp[27] += $temp[$j];
					}

					
					$table[$k] = $temp ;
					$k++;
				}
				
			}

				$total1_arr = array_fill(0,28, 0);
				for($i=0;$i<count($table);$i++){
					for($j=0;$j<count($table[$i]);$j++){
						$total1_arr[$j] += $table[$i][$j]; 
					}
					
				}

			$course_name2 = array();
			$table2       = array();
			$k            = 0 ;

			for($i=count($courses)-4;$i<count($courses);$i++){

				//Department from 0 (ENG) => 8
				if($type==1){
					$start_dep = 0;
					$end_dep = 8;
				}else{
					$start_dep = $type-1;
					$end_dep = $start_dep;
				}
				for($dep=$start_dep;$dep<=$end_dep;$dep++){
					$temp       = array(0,0,0,0,0,0,0,0,0,0);
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
						//$j--;
						$temp[10]  = $total;
						//fund = total*0.05
						$temp[11] = $total*0.05;
						$fund_index = 11;
						

						//eng = sum of input_type(Service,OH,donate)*faculty_percent *0.95 
						$temp[12] = round(($temp[self::$SERVICE_ID-1]*$percent[self::$SERVICE_ID]->faculty_percent/100)+
										  	 ($temp[self::$OH_ID-1]*$percent[self::$OH_ID]->faculty_percent/100)+
										  	 ($temp[self::$DONATE_ID-1]*$percent[self::$DONATE_ID]->faculty_percent/100)*0.95,2);
						$eng_index = 12;
						

						//lib = 0.95*lib value
						$temp[13] = $temp[self::$LIB_FEE_ID-1]*0.95;
						$lib_index = 13;
						

						//dept = sum of input_type(Service,OH,donate)*dept_percent *0.95 
						$temp[14] = round(($temp[self::$SERVICE_ID-1]*$percent[self::$SERVICE_ID]->department_percent/100)+
										  	 ($temp[self::$OH_ID-1]*$percent[self::$OH_ID]->department_percent/100)+
										  	 ($temp[self::$DONATE_ID-1]*$percent[self::$DONATE_ID]->department_percent/100)*0.95,2);
						$dept_index = 14;
						

						//total fund+lib+eng+dept
						$temp[15] = 0;
						for($l=$fund_index;$l<$dept_index+1;$l++){
							$temp[15] += $temp[$l];
						}
						//$j++;
						//start index for calculate total
						$start_index = 16;
						$j = $start_index;
						for($l=1;$l<count($departments)-2;$l++){
							if($dep == $departments[$l]->id){
								$temp[$j++] = $temp[$dept_index];
								
							}else{
								$temp[$j++] = 0;
							}
							
							
						}
						//BME
						$temp[23] = 0;
									
						//ENG $dep 0 = Eng
						if($dep == 0){
							$temp[24] = $temp[$eng_index];
						}else{
							$temp[24] = $temp[$eng_index]+$temp[$dept_index];
						}
						
						//Fund
						$temp[25] = $temp[$fund_index];
						
						//Lib
						$temp[26] = $temp[$lib_index];

						//total
						$temp[27] = 0;
						for($l=$start_index;$l<27;$l++){
							$temp[27] += $temp[$l];
						}
						
						$table2[$k] = $temp ;
						$k++;
					}
				}
			}

				$total2_arr = array_fill(0,28, 0);
				for($i=0;$i<count($table2);$i++){
					for($j=0;$j<count($table2[$i]);$j++){
						$total2_arr[$j] += $table2[$i][$j]; 
					}
					
				}

			$course_name3 = array();
			$table3       = array();
			$k            = 0 ;

			for($i=61;$i<=62;$i++){
						
				$course_id = $i ;
				if($type==1){
					$start_dep = 0;
					$end_dep = 8;
				}else{
					$start_dep = $type-1;
					$end_dep = $start_dep;
				}

				//Department from 0 (ENG) => 8
				for($dep=$start_dep;$dep<=$end_dep;$dep++){
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
							$temp[$income_type-1]    = $data[0]->result;
						}
						else $temp[$income_type-1] = 0 ;
					}

					if( !$is_null ) {
						$course_name3[$k][0] = $courses[$course_id-1]->name ;
						$course_name3[$k][1] = $dep ;
						$total = $temp[0]-$temp[9];
						//$j--;

						$temp[10]  = $total;
						//fund = total*0.05
						$temp[11] = $total*0.05;
						$fund_index = 11;

						//eng = sum of input_type(Service,OH,donate)*faculty_percent *0.95 
						$temp[12] = round(($temp[self::$CREDIT_FEE_ID-1]*$percent[self::$CREDIT_FEE_ID]->faculty_percent/100)*0.95,2);
						$eng_index = 12;
						

						//lib = 0.95*lib value
						$temp[13] = $temp[self::$LIB_FEE_ID-1]*0.95;
						$lib_index = 13;
						

						//dept = sum of input_type(Service,OH,donate)*dept_percent *0.95 
						$temp[14] = round(($temp[self::$CREDIT_FEE_ID-1]*$percent[self::$CREDIT_FEE_ID]->department_percent/100)*0.95,2);
						$dept_index = 14;
						

						//total fund+lib+eng+dept
						$temp[15] = 0;
						for($l=$fund_index;$l<15;$l++){
							$temp[15] += $temp[$l];
						}
						//$j++;
						//start index for calculate total
						$start_index = 16;
						$j = $start_index;

						for($l=1;$l<count($departments)-2;$l++){
							if($dep == $departments[$l]->id){
								$temp[$j++] = $temp[$dept_index];
								
							}else{
								$temp[$j++] = 0;
							}
							
							
						}
						//BME
						$temp[23] = 0;
									
						//ENG $dep 0 = Eng
						if($dep == 0){
							$temp[24] = $temp[$eng_index];
						}else{
							$temp[24] = $temp[$eng_index]+$temp[$dept_index];
						}
						
						//Fund
						$temp[25] = $temp[$fund_index];
						
						//Lib
						$temp[26] = $temp[$lib_index];

						//total
						$temp[27] = 0;
						for($l=$start_index;$l<27;$l++){
							$temp[27] += $temp[$l];
						}
						$table3[$k]          = $temp ;
						$k++;
					}
				}
			}

				$total3_arr = array_fill(0,28, 0);
				for($i=0;$i<count($table3);$i++){
					for($j=0;$j<count($table3[$i]);$j++){
						$total3_arr[$j] += $table3[$i][$j]; 
					}
					
				}

			$total = array_fill(0,28, 0);
			for($i=0;$i<28;$i++){
				$total[$i] = $total1_arr[$i]+$total2_arr[$i]+$total3_arr[$i];
			}

			if($type == 1){
				for($dep =1 ;$dep<=8;$dep++){
					$cost = $total[15+$dep];
					$data = DepartmentTotal::get($dep,$semester,$year);
					if(count($data)<=0){
						DepartmentTotal::insert($cost,$dep,$semester,$year);
					}else{
						$result = $data[0]->_update($cost);
					}
				}
			}

			$arr['table3']       = $table3;
			$arr['course_name3'] = $course_name3;
			$arr['total3']		 = $total3_arr;

			$arr['table2']       = $table2;
			$arr['course_name2'] = $course_name2;
			$arr['total2']		 = $total2_arr;

			$arr['table']        = $table ;
			$arr['course_name']  = $course_name ;
			$arr['total1']		 = $total1_arr;

			$arr['total']		 = $total;


			return View::make('report')->with('arr', $arr);
		
/*
			$arr['table3']       = $table3;
			$arr['course_name3'] = $course_name3;

			$arr['table2']       = $table2;
			$arr['course_name2'] = $course_name2;

			$arr['table']        = $table ;
			$arr['course_name']  = $course_name ;*/


			//return View::make('report_major')->with('arr', $arr);
		//}
	}

	public function getYear($year){
		$type = Auth::user()->type;
		if($type==1)
		{
			$arr['year']        = $year;
			$arr['departments'] = Department::all();
			
			foreach($arr['departments'] as $each){

				$last_year_major_money = MajorMoney::getByYear($each->id,$year-1);
				if(count($last_year_major_money)<=0){
					$val1[$each->id]	= 0;
				}else{
					$val1[$each->id]	= $last_year_major_money[0]->cost_balance;
				}

				$temp  = Expenditure1::where('department', $each->id)->where('year', $year)->first();
				if($temp['amount'] == "")
					$val3[$each->id] = 0;
				else
					$val3[$each->id] = $temp['amount'];

				
				$sum = DB::select("SELECT sum(amount) as sum from expenditure2 where year='".$year."' and department ='".$each->id."'");
				if( is_null($sum[0]->sum) )
					$val6[$each->id] = 0;
				else
					$val6[$each->id] = $sum[0]->sum;

				
				$income = DepartmentTotal::getByYear($year,$each->id);


				if( is_null($income[0]->sum) ){
					$val2[$each->id] = 0;
				}
				else{
					$val2[$each->id] = $income[0]->sum;
				}

				$val4[$each->id] = 0;

				$total_scch 	= array();
				$scch 			= array();
				$course_money 	= array();

				//semester 1 ,year
				$total_scch[1] 		= constant::getTotalSCCH(54,1,$year);
				$total_scch[2] 		= constant::getTotalSCCH(58,1,$year);
				$scch[1] 			= constant::getByDepartment($each->id+8,54,1,$year);
				$scch[2]			= constant::getByDepartment($each->id+8,58,1,$year);
				$course_money[1] 	= CourseMoney::get(54,1,$year);
				$course_money[2] 	= CourseMoney::get(58,1,$year);
				//semester 2 , year-1
				$total_scch[3] 		= constant::getTotalSCCH(54,2,$year-1);
				$total_scch[4] 		= constant::getTotalSCCH(58,2,$year-1);
				$scch[3] 			= constant::getByDepartment($each->id+8,54,2,$year-1);
				$scch[4] 			= constant::getByDepartment($each->id+8,58,2,$year-1);
				$course_money[3] 	= CourseMoney::get(54,2,$year-1);
				$course_money[4] 	= CourseMoney::get(54,2,$year-1);

				//semester 3 , year-1
				$total_scch[5] 		= constant::getTotalSCCH(54,3,$year-1);
				$scch[5] 			= constant::getByDepartment($each->id+8,54,3,$year-1);
				$course_money[5] 	= CourseMoney::get(54,3,$year-1);


				//sum(scch*course_money/total_scch)
				$val5[$each->id] = 0;
				for($i=1;$i<=5;$i++){
					if($total_scch[$i] == 0){
						$val5[$each->id] = '-';
						break;
					}
					else{
						$val5[$each->id] += $scch[$i]*$course_money[$i]/$total_scch[$i];
					}
				}				

				$val7[$each->id] = $val2[$each->id] + $val5[$each->id] + $val6[$each->id];
				$val8[$each->id] = $val3[$each->id] + $val4[$each->id];
				$val9[$each->id] = $val1[$each->id] + $val2[$each->id] - $val3[$each->id]
								   - $val4[$each->id] + $val5[$each->id] + $val6[$each->id];

				
				$major_money = MajorMoney::getByYear($each->id,$year);
				if(count($major_money)<=0){
					MajorMoney::insert($val9[$each->id],$each->id,$year);
				}else{
					$major_money[0]->_update($val9[$each->id]);
				}


			}

			$arr['val1'] = $val1; //เงินเหลือจ่ายปีก่อน
			$arr['val2'] = $val2; //99% รับจริง
			$arr['val3'] = $val3; //รายจ่าย
			$arr['val4'] = $val4; //เงินกันเหลื่อม
			$arr['val5'] = $val5; //ค่าสอนพื้นฐาน
			$arr['val6'] = $val6; //รับ/จ่าย สอนภายใน
			$arr['val7'] = $val7; //รับจริงทั้งหมด
			$arr['val8'] = $val8; //จ่ายจริงทั้งหมด
			$arr['val9'] = $val9; //เงินเหลือจ่ายปีปัจจุบัน
			return View::make('report-year')->with('arr', $arr);
		}
		else
		{
			$arr['year']        = $year;
			$arr['departments'] = Department::all();
			
				$last_year_major_money = MajorMoney::getByYear($type-1,$year-1);
				if(count($last_year_major_money)<=0){
					$val1[$type-1]	= 0;
				}else{
					$val1[$type-1]	= $last_year_major_money[0]->cost_balance;
				}

				$income = DepartmentTotal::getByYear($year,$type-1);
				if( is_null($income[0]->sum) ){
					$val2[$type-1] = 0;
				}
				else{
					$val2[$type-1] = $income[0]->sum;
				}

				$temp	= Expenditure1::where('department', ($type-1))->where('year', $year)->first();

				if($temp['amount'] == "")
					$val3[($type-1)] = 0;
				else
					$val3[($type-1)] = $temp['amount'];
			
				
				$val4[($type-1)] = 0;

				$total_scch 	= array();
				$scch 			= array();
				$course_money 	= array();

				//semester 1 ,year
				$total_scch[1] 		= constant::getTotalSCCH(54,1,$year);
				$total_scch[2] 		= constant::getTotalSCCH(58,1,$year);
				$scch[1] 			= constant::getByDepartment($type-1+8,54,1,$year);
				$scch[2]			= constant::getByDepartment($type-1+8,58,1,$year);
				$course_money[1] 	= CourseMoney::get(54,1,$year);
				$course_money[2] 	= CourseMoney::get(58,1,$year);
				//semester 2 , year-1
				$total_scch[3] 		= constant::getTotalSCCH(54,2,$year-1);
				$total_scch[4] 		= constant::getTotalSCCH(58,2,$year-1);
				$scch[3] 			= constant::getByDepartment($type-1+8,54,2,$year-1);
				$scch[4] 			= constant::getByDepartment($type-1+8,58,2,$year-1);
				$course_money[3] 	= CourseMoney::get(54,2,$year-1);
				$course_money[4] 	= CourseMoney::get(54,2,$year-1);

				//semester 3 , year-1
				$total_scch[5] 		= constant::getTotalSCCH(54,3,$year-1);
				$scch[5] 			= constant::getByDepartment($type-1+8,54,3,$year-1);
				$course_money[5] 	= CourseMoney::get(54,3,$year-1);


				//sum(scch*course_money/total_scch)
				$val5[$type-1] = 0;
				for($i=1;$i<=5;$i++){
					if($total_scch[$i] == 0){
						$val5[$type-1] = '-';
						break;
					}
					else{
						$val5[$type-1] += $scch[$i]*$course_money[$i]/$total_scch[$i];
					}
				}	

				$sum = DB::select("SELECT sum(amount) as sum from expenditure2 where year='".$year."' and department ='".($type-1)."'");

				if( is_null($sum[0]->sum) )
					$val6[($type-1)] = 0;
				else
					$val6[($type-1)] = $sum[0]->sum;			

				$val7[$type-1] = $val2[$type-1] + $val5[$type-1] + $val6[$type-1];
				$val8[$type-1] = $val3[$type-1] + $val4[$type-1];
				$val9[$type-1] = $val1[$type-1] + $val2[$type-1] - $val3[$type-1]
								   - $val4[$type-1] + $val5[$type-1] + $val6[$type-1];


			$arr['val1'] = $val1;
			$arr['val2'] = $val2;
			$arr['val3'] = $val3;
			$arr['val4'] = $val4;
			$arr['val5'] = $val5;
			$arr['val6'] = $val6;
			$arr['val7'] = $val7;
			$arr['val8'] = $val8;
			$arr['val9'] = $val9;

			return View::make('report-year')->with('arr', $arr);
		}

	}


	

}
