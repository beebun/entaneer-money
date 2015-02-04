@extends('layout')

@section('content')
<?php 
	$year 	      = $arr['year'];
	$table 	      = $arr['table'];
	
	//var_dump($table);
	//var_dump($year);
?> 

	<h4>รายงานเงินเหลือจ่ายประจำปี  <?php echo $year ; ?></h4>
	<hr>
	<table class="table table-bordered" style="font-size:13px">
		<thead>
			<th>ภาควิชา</th>
			<th>ยอดคงเหลือ</th>
		</thead>
		<?php for($i=0;$i<8;$i++){?>
			<tr>
				<td>{{ $departments[$i+1]->name }}</td>
				<td><input type="text" onchange="save_majormoney(this.value,{{ $i+1 }},{{ $year }})" class="form-control" style="font-size:13px" value="{{ $table[$i] }}"></td>
			</tr>
		<?php }?>

		
	</table>


	


	<script>


			function save_majormoney(money_value, department_id, year){
				$.post( "../majormoney", 
					{ 
						Years: year, 
						Department: department_id,
						Money_value: money_value,
					})
				.done(function( data ) {
					alert("บันทึกเรียบร้อย");
				})
				.error(function(data) {
					alert("พบข้อผิดพลาด!!!");	
				});
			}

			
	</script>
@stop

