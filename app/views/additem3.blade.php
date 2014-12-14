@extends('layout')

@section('content')

    

	<h4>เพิ่มรายรับ (ค่าจัดสรรค่าธรรมเนียม)</h4>
	<hr>
	<form method="post" action="additem" role="form" class="form-horizontal" style="">
		
		<div class="form-group">
			<label for="Detail" class="col-sm-2">รายละเอียด: </label>
			  <div class="col-sm-10">
			<input type="text" name="Detail" class="form-control" value="">
			</div>
		</div>


		<div class="form-group">
			<label for="Input_Type" class="col-sm-2">ประเภทรายรับ: </label>
			  <div class="col-sm-10">
			<select name="Input_Type" class="form-control">
				<option value="{{ $income_types[0]->id }}">{{ $income_types[0]->name }}</option>
			</select>
			</div>
		</div>


		<div class="form-group">
			<label for="Course" class="col-sm-2">เทอมการศึกษา: </label>
			  <div class="col-sm-10">
			<select name="Semester" class="form-control">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">summer</option>
			</select>
			</div>
		</div>


		<div class="form-group">
			<label for="Years" class="col-sm-2">ปีการศึกษา: </label>
			  <div class="col-sm-10">
			<select name="Years" class="form-control">
				<option value="2558">2558</option>
				<option value="2557">2557</option>
				<option value="2556">2556</option>
				<option value="2555">2555</option>
				<option value="2554">2554</option>
				<option value="2553">2553</option>
			</select>
			</div>
		</div>

		<div class="form-group">
			<label for="Course" class="col-sm-2">ชื่อรายรับ: </label>
			<div class="col-sm-10">
			<select name="Course" class="form form-control">
				<option value="{{ $courses[60]->id }}">{{ $courses[60]->name }}</option>
				<option value="{{ $courses[61]->id }}">{{ $courses[61]->name }}</option>
			</select> 
			</div>
		</div>
		
		<div class="form-group">
			<label for="Department" class="col-sm-2">ภาควิชา: </label>
			  <div class="col-sm-10">
			<select name="Department" class="form-control">
				<option value="0"> Eng</option>
				@foreach($departments as $department)
					<option value="{{ $department->id }}">{{ $department->name }}</option>
				@endforeach
			</select>
			</div>
		</div>


		<div class="form-group">
			<label for="Amount" class="col-sm-2">ยอดเงิน: </label>
			  <div class="col-sm-10">
			<input type="text" name="Amount" class="form-control" value="">
			</div>
		</div>

		
		<div class="form-group">
			<div class="col-md-2"></div>
			<div class="col-md-10"><input type="submit" name="submit" class="btn btn-primary" value="บันทึก"></div>
		</div>
	</form>
@stop

