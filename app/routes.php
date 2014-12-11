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

Route::get('/', function()
{
	// return View::make('hello');
	return Redirect::to('additem');	
});

Route::get('users', function()
{
    $users = User::all();

    return View::make('users')->with('users', $users);
});

Route::get('additem', function()
{
	$courses = course::all();
	$departments = department::all();
	$income_types = IncomeType::all();
	
    return View::make('additem')->with('courses', $courses)->with('departments', $departments)->with('income_types', $income_types);
});

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
	if($Amount!="")
	{
		$Amount         = Input::get('Amount');
		expenditure1::where('department', $department)->where('year', $year)->update(array(
            'department'    =>  $department,
            'year' =>  $year,
            'amount'  => $Amount,
        ));
		//$affectedRows = expenditure1:::where('department', $department)->where('year', $year)->update(array('amount' => $Amount));
	}
	else
	{
		$expenditure1->department   = Input::get('Department');
		$expenditure1->year			= Input::get('Years');
		$expenditure1->amount     	= Input::get('Amount');

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

Route::post('expenditure2', function()
{
	$expenditure2 = new Expenditure2;
	$expenditure2->department   = Input::get('Department');
	$expenditure2->year			= Input::get('Years');
	$expenditure2->amount     	= Input::get('Amount');

	// save our duck
	$expenditure2->save();
	// redirect ----------------------------------------
	// redirect our user back to the form so they can do it all over again
	return Redirect::to('expenditure2');	
});

Route::post('getAmount', function()
{
	$expenditure1 = expenditure1::all();
	
	$department   = Input::get('Department');
	$year         = Input::get('Years');
	$Amount       = expenditure1::where('department', $department)->where('year', $year)->get();
	//$Amount = expenditure1::where('year', $year)->get('amount');
	// return $expenditure1;
	return $Amount;
});






Route::get('report/{semaster}/{year}',  array('as' => 'report', function($semaster, $year) {

	$arr['semaster'] = $semaster;
	$arr['year'] = $year;
	// return View::make('view-report')->with('departments', $departments);
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

	// $sum = DB::select("SELECT department, sum(amount) as sum from expenditure2 where year='".$year."' group by department");


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





