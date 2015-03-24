@extends('layout')

@section('content')

	<?php 
		$year        = $arr['year'];
		$departments = $arr['departments'];
		$val         = $arr['val'];
		$val2        = $arr['val2'];
		$type = Auth::user()->type;
	?>  
	<form class="form-inline">
  <div class="form-group">
    <label>ปีการศึกษา</label>
    <select class="form-control"id="select_year">
    	<option>2552</option>
		<option>2553</option>
		<option>2554</option>
    	<option>2555</option>
		<option>2556</option>
		<option>2557</option>
    	<option>2558</option>
	</select>
  </div>
</form>  
	
	<h4>Report Year {{$year}}</h4>
	<hr>
	@if ($type == 1)
		<table class="table table-bordered">
		<thead>
			<th>ภาควิชา</th>
			<th>เงินเหลือจ่าย {{$year-1}}</th>
			<th>99% รายรับจริง {{$year}}</th>
			<th>รายจ่าย {{$year}}</th>
			<th>เงินกันเหลื่อม {{$year}}</th>
			<th>ค่าสอนพื้นฐาน</th>
			<th>รับ(+) จ่าย(-) สอนในคณะ</th>
			<th>รับจริงทั้งหมด</th>
			<th>จ่ายจริงทั้งหมด</th>
			<th>เงินเหลือจ่าย {{$year}}</th>
		</thead>

		@for($i=0;$i<count($departments);$i++)
		<tr>
			<td>{{$departments[$i]->name}}</td>
			<td></td>
			<td></td>
			<td>{{$val[$i]}}</td>
			<td></td>
			<td></td>
			<td>{{$val2[$i]}}</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@endfor

		</table>
	@else
			<table class="table table-bordered">
			<thead>
				<th>ภาควิชา</th>
				<th>เงินเหลือจ่าย {{$year-1}}</th>
				<th>99% รายรับจริง {{$year}}</th>
				<th>รายจ่าย {{$year}}</th>
				<th>เงินกันเหลื่อม {{$year}}</th>
				<th>ค่าสอนพื้นฐาน</th>
				<th>รับ(+) จ่าย(-) สอนในคณะ</th>
				<th>รับจริงทั้งหมด</th>
				<th>จ่ายจริงทั้งหมด</th>
				<th>เงินเหลือจ่าย {{$year}}</th>
			</thead>


			<tr>
				<td>{{$departments[$type-1]->name}}</td>
				<td></td>
				<td></td>
				<td>{{$val[$type-1]}}</td>
				<td></td>
				<td></td>
				<td>{{$val2[$type-1]}}</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>


			</table>	
	@endif
<script>
	$(document).ready(function(){
		$('#select_year').val("{{$year}}");
	});
	$('#select_year').change(function(){
		var value = $(this).val();
		window.location.href = "{{url('report/year')}}/"+value;
	});
	
	</script>	
@stop

