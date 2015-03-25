@extends('layout')

@section('content')

	<h4>แก้ไขค่าคงที่</h4>
	<hr>
	<h5><strong>ค่า Percent</strong></h5>
	<table class="table table-bordered" style="font-size:13px">
		<thead>
			<th>ประเภทรายรับ</th>
			<th>ภาควิชา</th>
			<th>คณะ</th>
		</thead>
		<tbody>
			@foreach($percent as $each)
				<tr>
					<td>{{$each->name}}</td>
					<td><input type="text" onchange="save_percent({{$each->id}},this.value,1)"class="form-control" style="font-size:13px" value="{{$each->department_percent}}"></td>
					<td><input type="text" onchange="save_percent({{$each->id}},this.value,2)"class="form-control" style="font-size:13px" value="{{$each->faculty_percent}}"></td>
				</tr>
			@endforeach
		</tbody>
		
	</table>
	<script>
		function save_percent(id,percent_value,type){

				$.post( "percent", 
					{ 
						percent: percent_value, 
						id:id,
						type:type
					})
				.done(function( data ) {
					alert("บันทึกเรียบร้อย");
				})
				.error(function(data) {
					console.log(data);
					alert("พบข้อผิดพลาด!!!");	
				});
			}
	</script>
@stop

