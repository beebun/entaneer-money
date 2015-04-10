@extends('layout')

@section('content')
	<form class="form-inline">
	  <div class="form-group">
	    <label>ภาคการศึกษา</label>
	    <select class="form-control"id="select_year">
	    	<option value="2558">2558</option>
			<option value="2557">2557</option>
			<option value="2556">2556</option>
			<option value="2555">2555</option>
			<option value="2554">2554</option>
			<option value="2553">2553</option>
			<option value="2552">2552</option>
		</select>
	  </div>
	</form>
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
				var year = $('#select_year').val();

				$.post( "../percent", 
					{ 
						percent: percent_value, 
						id:id,
						type:type,
						year:year
					})
				.done(function( data ) {
					alert("บันทึกเรียบร้อย");
				})
				.error(function(data) {
					console.log(data);
					alert("พบข้อผิดพลาด!!!");	
				});
			}
			$(document).ready(function(){
				$('#select_year').val("{{$year}}");
			});
			$('#select_year').change(function(){
				var value = $(this).val();
				window.location.href = "{{url('percent')}}/"+value;
			});
	</script>
@stop

