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

// route to show the login form
Route::get('login', array('uses' => 'HomeController@showLogin'));

// route to process the form
Route::post('login', array('uses' => 'HomeController@doLogin'));

Route::get('logout', function()
{
	Auth::logout();
    return View::make('login');
});

Route::group(array('before' => 'auth'), function(){
    
	Route::group(array('before'=>'admin'),function(){

		Route::get('usermanage', function()
		{
			$users = User::all();
			$usertype = UserType::all();

			return View::make('usermanage')->with('users', $users)->with('usertype', $usertype);
		});
		
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
			$user->type   		= Input::get('usertype');
			
			// save our duck
			$user->save();
			// redirect ----------------------------------------
			// redirect our user back to the form so they can do it all over again
			return Redirect::to('usermanage');	
		});
		
		Route::post('checkusername', function()
		{
			$users = User::all();
			
			$username = Input::get('username');
			$value     = User::where('username', $username)->get();
			
			return $value;
		});

		Route::post('checkpassword', function()
		{
			$password = Input::get('password');
			$new_password = Input::get('new_password');
			$repassword = Input::get('repassword');
			$response = array();
			$user = Auth::user();
			if($password == ''){
				$response['valid'] = 'false';
				$response['message'] = 'กรุณากรอก password ปัจจุบัน';
			}		
			else if(!Hash::check($password,$user->password)){
				$response['valid'] = 'false';
				$response['message'] = 'password ไม่ถูกต้อง';
			}else if($new_password==''){
				$response['valid'] = 'false';
				$response['message'] = 'กรุณากรอก password ใหม่';
			}else if(strlen($new_password)<6){
				$response['valid'] = 'false';
				$response['message'] = 'กรุณาตั้งรหัสตั้งแต่ 6 ตัวขึ้นไป';
			}else if($new_password!=$repassword){
				$response['valid'] = 'false';
				$response['message'] = 'password ไม่ตรงกัน';
			}else{
				$response['valid'] = 'true';
				$response['message'] = '';
			}
			return Response::json($response);
		});
		
		Route::get('edituser/{id}', array('as' => 'edituser', function($id)
		{
			$users = User::all();
			$UserType = UserType::all();

			return View::make('edituser')->with('usertype', $UserType)->with('users', $users)->with('id', $id);
		}));
		
		Route::post('edituser/{id}', array('as' => 'edituser', function($id)
		{
			$users = new User;
			
			$username  	= Input::get('username');
			$password = Hash::make(Input::get('password'));
			$name     	= Input::get('name');
			$type     	= Input::get('usertype');

			user::where('id', ($id))->update(array(
					'username'    =>  $username,
					'password' =>  $password,
					'name'  => $name,
					'type'  => $type,
			));
			return Redirect::to('usermanage');
		}));
		Route::post('deleteuser', function()
		{

			$id  	= Input::get('id');
			DB::delete('delete from users where id='.$id);
			
			return Redirect::to('usermanage');
		});

		Route::get('users', function()
		{
			$users = User::all();

			return View::make('users')->with('users', $users);
		});

		//Add รายรับแบบปกติ
		Route::get('additem', array('as' => 'additem', function()
		{
			$courses = Course::all();
			$departments = Department::all();
			$income_types = IncomeType::all();
			
			return View::make('additem')->with('courses', $courses)->with('departments', $departments)->with('income_types', $income_types);
		}));

		//Add Service/OH/อื่นๆ
		Route::get('additem2', array('as' => 'additem2', function()
		{
			$courses = Course::all();
			$departments = Department::all();
			$income_types = IncomeType::all();
			
			return View::make('additem2')->with('courses', $courses)->with('departments', $departments)->with('income_types', $income_types);
		}));

		//Add ค่าจัดสรรค่าธรรมเนียม
		Route::get('additem3', array('as' => 'additem3', function()
		{
			$courses = Course::all();
			$departments = Department::all();
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
			return Redirect::to('additem')->with('success', 'บันทึกสำเร็จ');	
		});

		Route::get('expenditure1', function()
		{
			$departments = Department::all();
			$expenditure1 = Expenditure1::all();
			
			return View::make('addexpenditure1')->with('departments', $departments)->with('expenditure1', $expenditure1);
		});


		Route::post('expenditure1', function()
		{
			$expenditure1 = new Expenditure1;
			$department   = Input::get('Department');
			$year         = Input::get('Years');

			$Amount = Expenditure1::where('department', $department)->where('year', $year)->get();
			
			if(count($Amount)>0)
			{
				$Amount         = Input::get('Amount');
				$Detail         = Input::get('Detail');
				Expenditure1::where('department', $department)->where('year', $year)->update(array(
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
			return Redirect::to('expenditure1')->with('success', 'บันทึกสำเร็จ');	;	
		});



		Route::get('expenditure2', function()
		{
			$departments = Department::all();
			
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

			$Amount = Expenditure2::where('department', $department)->where('year', $year)->get();
			
			if(count($Amount)>0)
			{
				$Amount         = Input::get('Amount');
				$Detail 		= Input::get('Detail');
				Expenditure2::where('department', $department)->where('year', $year)->update(array(
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
			return Redirect::to('expenditure2')->with('success', 'บันทึกสำเร็จ');	;
		});




		Route::post('getAmount', function()
		{
			$expenditure1 = Expenditure1::all();
			
			$department   = Input::get('Department');
			$year         = Input::get('Years');
			$Amount       = Expenditure1::where('department', $department)->where('year', $year)->get();
			return $Amount;
		});



		Route::post('getAmount2', function()
		{
			$expenditure1 = Expenditure1::all();
			
			$department   = Input::get('Department');
			$year         = Input::get('Years');
			$Amount       = Expenditure2::where('department', $department)->where('year', $year)->get();
			return $Amount;
		});



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
			
			$departments = DepartmentC::all();
			$courses     = Course::all();
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
			$percent	= Percent::all();

			return View::make('percent')->with('arr', $arr)->with('percent', $percent);
			
		}));

		Route::post('percent', array( "as"=>"post_add_percent" ,function()
		{
			$id				= Input::get('id');
			$percent_value	= Input::get('percent');
			$type 			= Input::get('type');

			$percent = Percent::find($id);
			if($type == 1)
				$percent->department_percent = $percent_value;
			if($type == 2)
				$percent->faculty_percent 	 = $percent_value;
			$percent->save();
			
			return Redirect::to('percent');	
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
		
		
		
		
		
		
		Route::get('majormoney/{year}',  array('as' => 'addmajormoney', function($year) 
		{
			$arr['year'] = $year;
			$table       = array();
			$temp    = array();
			$is_null = true ;
			
			$departments = Department::all();
			
			for($i=0;$i<8;$i++){//course
					
				$data = DB::select("SELECT cost_balance 
									FROM major_money  
									WHERE department_id='".($i+1)."' 
										and years='".$year."'
									");

				if( count($data)>0)  {
					$temp[$i] = $data[0]->cost_balance;
				}
				else{
					$temp[$i] = 0 ;
				}	
			}
			$table = $temp ;
						
			$arr['table']       = $table ;
			//$arr['course_name'] = $course_name ;

			return View::make('addmajormoney')->with('arr', $arr)->with('departments', $departments);
			
		}));
		
		
		Route::post('majormoney', array( "as"=>"post_add_majormoney" ,function()
		{
			$majormoney = new MajorMoney;
			$department		= Input::get('Department');
			$year         	= Input::get('Years');

			$value     = MajorMoney::where('department_id', $department)->where('years', $year)->get();
			if(count($value)>0)
			{
				$money_value     = Input::get('Money_value');
				MajorMoney::where('department_id', $department)->where('years', $year)->update(array(
					'department_id' 	=>  $department,       
					'years'    			=>  $year,
					'cost_balance' 		=>  $money_value
				));
				//$affectedRows = expenditure1:::where('department', $department)->where('year', $year)->update(array('amount' => $Amount));
			}
			else
			{
				$majormoney->department_id	= Input::get('Department');
				$majormoney->years   			= Input::get('Years');
				$majormoney->cost_balance		= Input::get('Money_value');

				// save our duck
				$majormoney->save();
			}
			// redirect ----------------------------------------
			// redirect our user back to the form so they can do it all over again
			
			return Redirect::to('majormoney/'.$year);	
		}));
		
	});
	Route::get('/', function()
	{
		// return View::make('hello');
		return Redirect::to('userprofile');	
	});

	Route::get('userprofile', function()
	{
		$users = User::all();

		return View::make('userprofile')->with('users', $users);
	});
	Route::get('edituserp/{id}', array('as' => 'edituserp', function($id)
	{
		$users = User::all();
		$UserType = UserType::all();

		return View::make('edituserp')->with('usertype', $UserType)->with('users', $users)->with('id', $id);
	}));
		
	Route::post('edituserp/{id}', array('as' => 'edituserp', function($id)
	{
		$users = new User;
			
		$password = Hash::make(Input::get('new_password'));
		$name     = Input::get('name');

		User::where('id', ($id))->update(array(
			'password' =>  $password,
			'name'  => $name,
		));
		return 'done';
	}));
	Route::get('restricted', function()
	{
		return View::make('restricted');
	});

	Route::controller('report', 'ReportController');

});