@extends('layout')

@section('content')

    
	<h4>Edit constant</h4>
	<hr>
	
	<form method="post" action="constant" class="form-horizontal">
	
		<div class="form-group">
			<label for="Course" class="col-sm-2">หลักสูตร: </label>
			<div class="col-sm-10">
			<select name="Course" id="Course" class="form form-control">
				<option value=""> ========== เลือก =========</option>

				<?php for($i=53;$i<60;$i++): ?>
					<option value="{{ $courses[$i]->id }}">{{ $courses[$i]->name }}</option>
				<?php endfor ?>
			</select> 
			</div>
		</div>
	
		<div class="form-group">
			<label for="Department" class="col-sm-2">ภาควิชา: </label>
			  <div class="col-sm-10">
			<select name="Department" id="Department" class="form-control">
				<option value=""> ========== เลือก =========</option>
				@foreach($departments as $department)
					<option value="{{ $department->id }}">{{ $department->name }}</option>
				@endforeach
			</select>
			</div>
		</div>

		<div class="form-group">
			<label for="Semester" class="col-sm-2">เทอมการศึกษา: </label>
			  <div class="col-sm-10">
			<select name="Semester" id="Semester" class="form-control">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">summer</option>
			</select>
			</div>
		</div>
		
		<div class="form-group">
			<label for="Years" class="col-sm-2">ปีการศึกษา: </label>
			<div class="col-md-10">
				<select name="Years" id="Years" class="Years form-control">
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
			<label for="Scch_value" class="col-sm-2">Scch_value: </label>
			<div class="col-md-10">
				<input type="text" name="Scch_value" id="Scch_value" value="" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label for="Student_amount" class="col-sm-2">Student_amount: </label>
			<div class="col-md-10">
				<input type="text" name="Student_amount" id="Student_amount" value="" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-2"></div>
			<div class="col-md-10"><input type="submit" name="submit" class="btn btn-primary" value="บันทึก"></div>
		</div>
	</form>


	<script>


			function get_saved_value(){
				var Course = document.getElementById("Course").value;
				var Semester = document.getElementById("Semester").value;
				var Years = document.getElementById("Years").value;
				var Department = document.getElementById("Department").value;
				//alert( Years+" "+Department);
				
				$.post( "getValue", { Course: Course, Semester: Semester, Years: Years, Department: Department }).done(function( data ) {
					if(data.length > 0){
						//console.log(data);
						$('#Scch_value').val(data[0].scch_value);
						$('#Student_amount').val(data[0].student_amount);
					}else{
						$('#Scch_value').val("");
						$('#Student_amount').val("");
					}
				});
			}

			get_saved_value();
			
			$( "select" ).change(function() {
				get_saved_value();	
				/*var AmountValue = $.ajax({
					url: "/laravel/MoneyAnalysis/public/test",
					type: "POST",
					data: {
							"Years": Years,
							"Department": Department
						  },
				});
				
				AmountValue.done(function (res, textStatus, jqXHR){
					if (res.status = "ok"){     
						console.log(res);
					}
				});*/

			});
			
	</script>
@stop

