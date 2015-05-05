@extends('layout')

@section('content')

	<?php 
		//var_dump($arr);
		$year        = $arr['year'];
		$departments = $arr['departments'];
		$val1        = $arr['val1'];
		$val2        = $arr['val2'];
		$val3        = $arr['val3'];
		$val4        = $arr['val4'];
		$val5        = $arr['val5'];
		$val6        = $arr['val6'];
		$val7        = $arr['val7'];
		$val8        = $arr['val8'];
		$val9        = $arr['val9'];
		$total1		 = 0;
		$total2		 = 0;
		$total3		 = 0;
		$total4		 = 0;
		$total5		 = 0;
		$total6		 = 0;
		$total7		 = 0;
		$total8		 = 0;
		$total9		 = 0;
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
			<td>{{number_format($val1[$i],2,'.',',')}}</td>
			<td>{{number_format($val2[$i],2,'.',',')}}</td>
			<td>{{number_format($val3[$i],2,'.',',')}}</td>
			<td>{{number_format($val4[$i],2,'.',',')}}</td>
			@if(is_numeric($val5[$i]))
			<td>{{number_format($val5[$i],2,'.',',')}}</td>
			@else
			<td>{{$val5[$i]}}</td>
			@endif
			<td>{{number_format($val6[$i],2,'.',',')}}</td>
			<td>{{number_format($val7[$i],2,'.',',')}}</td>
			<td>{{number_format($val8[$i],2,'.',',')}}</td>
			<td>{{number_format($val9[$i],2,'.',',')}}</td>
		</tr>
		<?php $total1 += $val1[$i];
			  $total2 += $val2[$i];
			  $total3 += $val3[$i];
			  $total4 += $val4[$i];
			  $total5 += $val5[$i];
			  $total6 += $val6[$i];
			  $total7 += $val7[$i];
			  $total8 += $val8[$i];
			  $total9 += $val9[$i];?>
		@endfor
		<tr>
			<th>Total</th>
			<td>{{number_format($total1,2,'.',',')}}</td>
			<td>{{number_format($total2,2,'.',',')}}</td>
			<td>{{number_format($total3,2,'.',',')}}</td>
			<td>{{number_format($total4,2,'.',',')}}</td>
			<td>{{number_format($total5,2,'.',',')}}</td>
			<td>{{number_format($total6,2,'.',',')}}</td>
			<td>{{number_format($total7,2,'.',',')}}</td>
			<td>{{number_format($total8,2,'.',',')}}</td>
			<td>{{number_format($total9,2,'.',',')}}</td>
		</tr>
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
				<td>{{number_format($val1[$type-1],2,'.',',')}}</td>
				<td>{{number_format($val2[$type-1],2,'.',',')}}</td>
				<td>{{number_format($val3[$type-1],2,'.',',')}}</td>
				<td>{{number_format($val4[$type-1],2,'.',',')}}</td>
				@if(is_numeric($val5[$type-1]))
				<td>{{number_format($val5[$type-1],2,'.',',')}}</td>
				@else
				<td>{{$val5[$type-1]}}</td>
				@endif
				<td>{{number_format($val6[$type-1],2,'.',',')}}</td>
				<td>{{number_format($val7[$type-1],2,'.',',')}}</td>
				<td>{{number_format($val8[$type-1],2,'.',',')}}</td>
				<td>{{number_format($val9[$type-1],2,'.',',')}}</td>
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

