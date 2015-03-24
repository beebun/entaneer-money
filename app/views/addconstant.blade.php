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
	<form class="form-inline">
	  <div class="form-group">
	    <label>ภาคการศึกษา</label>
	    <select class="form-control"id="select_year">
	    	<option>1/2552</option>
			<option>2/2552</option>
			<option>3/2552</option>
	    	<option>1/2553</option>
			<option>2/2553</option>
			<option>3/2553</option>
	    	<option>1/2554</option>
			<option>2/2554</option>
			<option>3/2554</option>
	    	<option>1/2555</option>
			<option>2/2555</option>
			<option>3/2555</option>
	    	<option>1/2556</option>
			<option>2/2556</option>
			<option>3/2556</option>
	    	<option>1/2557</option>
			<option>2/2557</option>
			<option>3/2557</option>
			<option>1/2558</option>
			<option>2/2558</option>
			<option>3/2558</option>
		</select>
	  </div>
	</form>
	<h4>ค่าคงที่ <?php $dcount=0; echo $semester."/".$year ; ?></h4>
	<hr>
	<h5><strong>ค่า SCCH</strong></h5>
	<table class="table table-bordered" style="font-size:13px">
		<thead>
			<th>หลักสูตร</th>
			@foreach($departments as $department)
				<th>{{ $department->name }}</th><?php $dcount++;?>
			@endforeach
			<th>Eng-All</th>
			<th>Total</th><?php $dcount=$dcount+2;?>
		</thead>
		<?php for($i=54;$i<61;$i++): $total=0;$engtotal=0;?>
			<tr>
				<td>{{ $courses[$i-1]->name }} {{ $courses[$i-1]->id }}</td>

				<?php for($j=0;$j<$dcount-2;$j++) :?>
					<td>
						<?php //echo $table[$j][$i-54]; ?>
						<!--{{ $courses[$i-1]->id }} {{$departments[$j]->id}} {{$year}} {{$semester}}-->
						<input type="text" onchange="save_scch(this.value, {{ $table2[$j][$i-54]}}, {{ $courses[$i-1]->id }}, {{$departments[$j]->id}}, {{$year}}, {{$semester}})" class="form-control" style="font-size:13px" value="{{ $table[$j][$i-54] }}">
					</td>
					<?php 
						$total=$total+$table[$j][$i-54];
						if($j>8)
						{
							$engtotal=$engtotal+$table[$j][$i-54];
						}
					?>
				<?php endfor ?>
				<td><?php echo $engtotal;?></td>
				<td><?php echo $total;?></td>
			</tr>
		<?php endfor ?>
		
	</table>


	<h5><strong>จำนวนนักศึกษา</strong></h5>
	<table class="table table-bordered">
		<thead>
			<th>หลักสูตร</th>
			@foreach($departments as $department)
				<th>{{ $department->name }}</th>
			@endforeach
			<th>Eng-All</th>
			<th>Total</th>
		</thead>
		<?php for($i=54;$i<61;$i++): $total=0;$engtotal=0;?>
			<tr>
				<td>{{ $courses[$i-1]->name }}</td>

				<?php for($j=0;$j<$dcount-2;$j++) :?>
					<td>
						<?php //echo $table2[$j][$i-54];?>
						<input type="text" onchange="save_scch({{ $table[$j][$i-54]}}, this.value ,{{ $courses[$i-1]->id }}, {{$departments[$j]->id}}, {{$year}}, {{$semester}})" class="form-control" style="font-size:13px" value="{{ $table2[$j][$i-54] }}">

					</td>
					<?php 
						$total=$total+$table2[$j][$i-54];
						if($j>8)
						{
							$engtotal=$engtotal+$table2[$j][$i-54];
						}
					?>
				<?php endfor ?>
				<td><?php echo $engtotal;?></td>
				<td><?php echo $total;?></td>
			</tr>
		<?php endfor ?>
		

	</table>
	<br/>	

   	<!--
	<h4>Edit constant</h4>
	<hr>
	{{ Form::open(array('route' => 'post_add_constant','class'=>'form-horizontal')) }}
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
	</form>-->


	<script>


			function save_scch(scch_value, student_amount, course_id, department_id, year, semester){

				$.post( "../../constant", 
					{ 
						Course: course_id, 
						Semester: semester, 
						Years: year, 
						Department: department_id,
						Scch_value: scch_value,
						Student_amount: student_amount
					})
				.done(function( data ) {
					alert("บันทึกเรียบร้อย");
				})
				.error(function(data) {
					alert("พบข้อผิดพลาด!!!");	
				});
			}

			function get_saved_value(){
				var Course     = document.getElementById("Course").value;
				var Semester   = document.getElementById("Semester").value;
				var Years      = document.getElementById("Years").value;
				var Department = document.getElementById("Department").value;
				
				$.post( "../../getValue", 
					{ 
						Course: Course, 
						Semester: Semester, 
						Years: Years, 
						Department: Department 
					})
				.done(function( data ) {
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

			//get_saved_value();
			
			$( ".select" ).change(function() {
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

			$(document).ready(function(){
				$('#select_year').val("{{$semester.'/'.$year}}");
			});
			$('#select_year').change(function(){
				var value = $(this).val();
				window.location.href = "{{url('constant')}}/"+value;
			});
			
	</script>
@stop

