@extends('layout')

@section('content')
<?php 
	$year 	      = $arr['year'];
	$semester  	  = $arr['semester'];
	$table 	      = $arr['table'];
	$table2  	  = $arr['table2'];
	//var_dump($table);
	//var_dump($table2);
?> 

	<h4>รายงาน <?php $dcount=0; echo $semester."/".$year ; ?></h4>
	<hr>
	<h5><strong>ค่า SCCH</strong></h5>
	<table class="table table-bordered">
		<thead>
			<th>หลักสูตร</th>
			@foreach($departments as $department)
				<th>{{ $department->name }}</th><?php $dcount++;?>
			@endforeach
			<th>Eng-All</th>
			<th>Total</th><?php $dcount=$dcount+2;?>
		</thead>
		<?php for($i=54;$i<61;$i++): ?>
			<tr>
				<td>{{ $courses[$i-1]->name }}</td>

				<?php for($j=0;$j<$dcount-2;$j++) :?>
					<td><?php echo $table[$j][$i-54] ; ?></td>
				<?php endfor ?>
								<td class="disabled"></td>
				<td class="disabled"></td>
			</tr>
		<?php endfor ?>
		
	</table>


	<h5><strong>จำนวนนักเรียน</strong></h5>
	<table class="table table-bordered">
		<thead>
			<th>หลักสูตร</th>
			@foreach($departments as $department)
				<th>{{ $department->name }}</th>
			@endforeach
			<th>Eng-All</th>
			<th>Total</th>
		</thead>
		<?php for($i=54;$i<61;$i++): ?>
			<tr>
				<td>{{ $courses[$i-1]->name }}</td>

				<?php for($j=0;$j<$dcount-2;$j++) :?>
					<td><?php echo $table2[$j][$i-54]; ?></td>
				<?php endfor ?>
				<td class="disabled"></td>
				<td class="disabled"></td>
			</tr>
		<?php endfor ?>
		

	</table>
	<br/>	

    
	<h4>Edit constant</h4>
	<hr>
	
	{{ Form::open(array('route' => 'post_add_constant','class'=>'form-horizontal')) }}

	<!-- <form method="post" action="constant" class="form-horizontal"> -->
	
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

