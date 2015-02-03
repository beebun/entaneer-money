@extends('layout')

@section('content')
<?php 
	$year 	      = $arr['year'];
	$table 	      = $arr['table'];
	
	//var_dump($table);
	//var_dump($table2);
?> 

	<h4>รายงาน <?php $dcount=0; echo $year ; ?></h4>
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

		
	</table>


	


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

