<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(array('before' => 'auth'), function(){
    Route::get('/', function()
	{
		// return View::make('hello');
		return Redirect::to('usermanage');	
	});
});

// route to show the login form
Route::get('login', array('uses' => 'HomeController@showLogin'));

// route to process the form
Route::post('login', array('uses' => 'HomeController@doLogin'));

Route::get('genuser', function()
{
    $UserType = UserType::all();

    return View::make('genuser')->with('usertype', $UserType);
});
Route::post('genuser', function()
{
	/* hash password*/
	$password = Hash::make(Input::get('password'));
	$user = new User;
	$user->username		= Input::get('username');
	$user->password  	= $password;
	$user->name   		= Input::get('name');
	
	// save our duck
	$user->save();
	// redirect ----------------------------------------
	// redirect our user back to the form so they can do it all over again
	return Redirect::to('login');	
});
Route::get('usermanage', function()
{
    $users = User::all();

    return View::make('usermanage')->with('users', $users);
});
Route::post('checkusername', function()
{
	$users = User::all();
	
	$username = Input::get('username');
	$value     = User::where('username', $username)->get();
	
	return $value;
});





Route::get('users', function()
{
    $users = User::all();

    return View::make('users')->with('users', $users);
});








//Add รายรับแบบปกติ
Route::get('additem', array('as' => 'additem', function()
{
	$courses = course::all();
	$departments = department::all();
	$income_types = IncomeType::all();
	
    return View::make('additem')->with('courses', $courses)->with('departments', $departments)->with('income_types', $income_types);
}));






//Add Service/OH/อื่นๆ
Route::get('additem2', array('as' => 'additem2', function()
{
	$courses = course::all();
	$departments = department::all();
	$income_types = IncomeType::all();
	
    return View::make('additem2')->with('courses', $courses)->with('departments', $departments)->with('income_types', $income_types);
}));






//Add ค่าจัดสรรค่าธรรมเนียม
Route::get('additem3', array('as' => 'additem3', function()
{
	$courses = course::all();
	$departments = department::all();
	$income_types = IncomeType::all();
	
    return View::make('additem3')->with('courses', $courses)->with('departments', $departments)->with('income_types', $income_types);
}));








Route::post('additem', function()
{
	$item = new Item;
	$item->course     	= Input::get('Course');
	$item->income_type  = Input::get('Input_Type');
	$item->department   = Input::get('Department');
	$item->semester     = Input::get('Semester');
	$item->year			= Input::get('Years');
	$item->amount     	= Input::get('Amount');
	$item->detail     	= Input::get('Detail');

	// save our duck
	$item->save();
	// redirect ----------------------------------------
	// redirect our user back to the form so they can do it all over again
	return Redirect::to('additem');	
});









Route::get('expenditure1', function()
{
	$departments = department::all();
	$expenditure1 = expenditure1::all();
	
    return View::make('addexpenditure1')->with('departments', $departments)->with('expenditure1', $expenditure1);
});









Route::post('expenditure1', function()
{
	$expenditure1 = new Expenditure1;
	$department   = Input::get('Department');
	$year         = Input::get('Years');

	$Amount = expenditure1::where('department', $department)->where('year', $year)->get();
	
	if(count($Amount)>0)
	{
		$Amount         = Input::get('Amount');
		$Detail         = Input::get('Detail');
		expenditure1::where('department', $department)->where('year', $year)->update(array(
            'department'    =>  $department,
            'year' =>  $year,
            'amount'  => $Amount,
            'detail'  => $Detail,
        ));
		//$affectedRows = expenditure1:::where('department', $department)->where('year', $year)->update(array('amount' => $Amount));
	}
	else
	{
		$expenditure1->department   = Input::get('Department');
		$expenditure1->year			= Input::get('Years');
		$expenditure1->amount     	= Input::get('Amount');
		$expenditure1->detail     	= Input::get('Detail');

		// save our duck
		$expenditure1->save();
	}
	// redirect ----------------------------------------
	// redirect our user back to the form so they can do it all over again
	return Redirect::to('expenditure1');	
});








Route::get('expenditure2', function()
{
	$departments = department::all();
	
    return View::make('addexpenditure2')->with('departments', $departments);
});








// Route::post('expenditure2', function()
// {
// 	$expenditure2 = new Expenditure2;
// 	$expenditure2->department   = Input::get('Department');
// 	$expenditure2->year			= Input::get('Years');
// 	$expenditure2->amount     	= Input::get('Amount');

// 	// save our duck
// 	$expenditure2->save();
// 	// redirect ----------------------------------------
// 	// redirect our user back to the form so they can do it all over again
// 	return Redirect::to('expenditure2');	
// });

Route::post('expenditure2', function()
{
	$expenditure2 = new Expenditure2;
	$department   = Input::get('Department');
	$year         = Input::get('Years');

	$Amount = expenditure2::where('department', $department)->where('year', $year)->get();
	
	if(count($Amount)>0)
	{
		$Amount         = Input::get('Amount');
		$Detail 		= Input::get('Detail');
		expenditure2::where('department', $department)->where('year', $year)->update(array(
            'department'    =>  $department,
            'year' =>  $year,
            'amount'  => $Amount,
            'detail'  => $Detail,
        ));
	}
	else
	{
		$expenditure2->department   = Input::get('Department');
		$expenditure2->year			= Input::get('Years');
		$expenditure2->amount     	= Input::get('Amount');
		$expenditure2->detail     	= Input::get('Detail');

		$expenditure2->save();
	}
	return Redirect::to('expenditure2');
});










Route::post('getAmount', function()
{
	$expenditure1 = expenditure1::all();
	
	$department   = Input::get('Department');
	$year         = Input::get('Years');
	$Amount       = expenditure1::where('department', $department)->where('year', $year)->get();
	return $Amount;
});



Route::post('getAmount2', function()
{
	$expenditure1 = expenditure1::all();
	
	$department   = Input::get('Department');
	$year         = Input::get('Years');
	$Amount       = expenditure2::where('department', $department)->where('year', $year)->get();
	return $Amount;
});








Route::get('report/{semester}/{year}',  array('as' => 'report', function($semester, $year) {

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
}));









Route::get('report-year/{year}', array('as' => 'report-year', function($year) {

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
}));










/*
Route::get('constant', function()
{
	$departments = departmentc::all();
	$courses = course::all();
	
    return View::make('addconstant')->with('departments', $departments)->with('courses', $courses);
});
*/
Route::get('constant/{semester}/{year}',  array('as' => 'addconstant', function($semester, $year) 
{
	$arr['semester']     = $semester;
	$arr['year']         = $year;

	$table       = array();
	$table2       = array();
	$course_name = array();
	
	$departments = departmentc::all();
	$courses     = course::all();
	$k           = 0 ;
	$k2           = 0 ;
	
	foreach($departments as $department){
		$temp    = array();
		$temp2    = array();
		$is_null = true ;
		$is_null2 = true ;

		for($i=54;$i<61;$i++){//course
			
			$course = $i ;
			$data = DB::select("SELECT scch_value, student_amount 
								FROM constant  
								WHERE course ='".$course."' 
									and department_c='".$department->id."' 
									and semester='".$semester."'
									and year='".$year."'
								");

			if( isset ($data[0]->scch_value))  {
				$temp[$i-54] = $data[0]->scch_value;
			}
			else{
				$temp[$i-54] = 0 ;
			}
			
			if( isset ($data[0]->student_amount) ) {
				$temp2[$i-54] = $data[0]->student_amount;
			}
			else{
				$temp2[$i-54] = 0 ;
			}
		}
			$table[$k] = $temp ;
			$k++;

			$table2[$k2] = $temp2 ;
			$k2++;

	}

	// var_dump($table);
	// var_dump($course_name);
	// echo "</pre>";
	// die();
	
	$arr['table']       = $table ;
	$arr['table2']       = $table2 ;
	//$arr['course_name'] = $course_name ;


	return View::make('addconstant')->with('arr', $arr)->with('departments', $departments)->with('courses', $courses);
	
}));










Route::get('percent',  array('as' => 'percent', function() 
{

	$arr         = Array();
	$departments = departmentc::all();
	$courses     = course::all();

	return View::make('percent')->with('arr', $arr)->with('departments', $departments)->with('courses', $courses);
	
}));










Route::post('constant', array( "as"=>"post_add_constant" ,function()
{
	$constant = new constant;
	$course       	= Input::get('Course');
	$department		= Input::get('Department');
	$semester  		= Input::get('Semester');
	$year         	= Input::get('Years');

	$value     = constant::where('course', $course)->where('department_c', $department)->where('semester', $semester)->where('year', $year)->get();
	if(count($value)>0)
	{
		$scch_value     = Input::get('Scch_value');
		$student_amount = Input::get('Student_amount');
		constant::where('course', $course)->where('department_c', $department)->where('semester', $semester)->where('year', $year)->update(array(
            'course'    		=>  $course,
            'department_c' 		=>  $department,
            'semester'  		=> 	$semester,            
			'year'    			=>  $year,
            'scch_value' 		=>  $scch_value,
            'student_amount'  	=> 	$student_amount
        ));
		//$affectedRows = expenditure1:::where('department', $department)->where('year', $year)->update(array('amount' => $Amount));
	}
	else
	{
		$constant->course   		= Input::get('Course');
		$constant->department_c		= Input::get('Department');
		$constant->semester     	= Input::get('Semester');
		$constant->year   			= Input::get('Years');
		$constant->scch_value		= Input::get('Scch_value');
		$constant->student_amount	= Input::get('Student_amount');

		// save our duck
		$constant->save();
	}
	// redirect ----------------------------------------
	// redirect our user back to the form so they can do it all over again
	
	return Redirect::to('constant/'.$semester.'/'.$year);	
}));











Route::post('getValue', function()
{
	$constant = constant::all();
	
	$course       	= Input::get('Course');
	$department		= Input::get('Department');
	$semester  		= Input::get('Semester');
	$year         	= Input::get('Years');
	
	$value     = constant::where('course', $course)->where('department_c', $department)->where('semester', $semester)->where('year', $year)->get();
	
	return $value;
});

