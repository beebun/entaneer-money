@extends('layout')

@section('content')

    
	<h4>Add Expenditure2</h4>
	<form method="post" action="expenditure2">

		Department: 
		<select name="Department">
			@foreach($departments as $department)
				<option value="{{ $department->id }}">{{ $department->name }}</option>
			@endforeach
		</select>
		<br><br>
		
		Years: 
		<select name="Years">
			<option value="2558">2558</option>
			<option value="2557">2557</option>
			<option value="2556">2556</option>
			<option value="2555">2555</option>
			<option value="2554">2554</option>
			<option value="2553">2553</option>
		</select>
		<br><br>
		
		Amount: <input type="text" name="Amount" value="">
		<br><br>

		<input type="submit" name="submit" value="Submit">
	</form>
@stop

