@extends('layout')

@section('content')

<?php 
	//var_dump($arr);
	$year         = $arr['year'];
	$semester     = $arr['semester'];
	$income_types = $arr['income_types'];
	
	$table        = $arr['table'];
	$course_name  = $arr['course_name'];
	$total1 	  = $arr['total1'];
	
	$table2       = $arr['table2'];
	$course_name2 = $arr['course_name2'];
	$total2 	  = $arr['total2'];
	
	$table3       = $arr['table3'];
	$course_name3 = $arr['course_name3'];
	$total3 	  = $arr['total3'];
	
	$departments  = $arr['departments'];
	$total 		  = $arr['total'];

	$type = Auth::user()->type;
	
?>    

<style>
.table-responsive>.fixed-column {
    position: absolute;
    display: inline-block;
    width: auto;
    border-right: 1px solid #ddd;
    background-color: #fff;
}
@media(max-width:768px) {
    .table-responsive>.fixed-column {
        display: none;
    }
}


</style>
<form class="form-inline">
  <div class="form-group">
    <label>ภาคการศึกษา</label>
    <select class="form-control"id="select_year">
    	<option>2/2551</option>
		<option>3/2551</option>
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
	<h4>รายงาน <?php echo $semester."/".$year ; ?></h4>
	
	<hr>
	@if($type ==1)
	<div class="table-responsive">
		<table class="table table-bordered scroll1">
		<thead>
			<th>
			@for($i=0;$i<count($income_types);$i++)
				<th ><?php echo $income_types[$i]->name; ?></th>
			@endfor
			<th>Total</th>
			<th class="danger"> Fund</th>
			<th class="danger"> ENG</th>
			<th class="danger"> Lib</th>
			<th class="danger"> Depart</th>
			<th class="danger" > Total</th>
			<?php for($i=1;$i<count($departments)-1;$i++) :?>
				<th class="success">{{$departments[$i]->name}}</th>
			<?php endfor;?>
			<th class="success"> ENG</th>
			<th class="success"> Fund</th>
			<th class="success"> Lib</th>
			<th class="success"> Total</th>
		</thead>
		<tr>
			<th>Total</th>
			@for($i=0;$i<count($total);$i++)
				<td>{{number_format($total[$i],2,'.',',')}}</td>
			@endfor
		</tr>
	</table>
	</div>
	@endif
	<h5><strong>ตามหลักสูตร</strong></h5>
	<div class="table-responsive">

	<table class="table table-bordered scroll2">
		<thead>
			<th style="width:120px">หลักสูตร</th>
			<th >ภาควิชา</th>
			<?php for($j=0;$j<count($income_types);$j++) :?>
				<th><?php echo $income_types[$j]->name; ?></th>
			<?php endfor ?>
			<th> Total</th>
			@if($type==1)
			<th class="danger"> Fund</th>
			<th class="danger"> ENG</th>
			<th class="danger"> Lib</th>
			<th class="danger"> Depart</th>
			<th class="danger"> Total</th>
			<?php for($i=1;$i<count($departments)-1;$i++) :?>
				<th class="success">{{$departments[$i]->name}}</th>
			<?php endfor;?>
			@else
				<th class="success">{{$departments[$type-1]->name}}</th>
			@endif
			<th class="success"> ENG</th>
			<th class="success"> Fund</th>
			<th class="success"> Lib</th>
			<th class="success"> Total</th>
		</thead>
		<?php for($i=0;$i<count($table);$i++) :?>
			<tr>
				<td><?php echo $course_name[$i][0]; ?></td>
				<td>
				{{ $departments[$course_name[$i][1]]->name }}
				</td>
				@for($j=0;$j<11;$j++)
				@if($j<6 || $j>8)
					<td>{{number_format($table[$i][$j],2,'.',',')}}</td>
				@else
					<td class="disabled"></td>
				@endif
				@endfor
				@if($type==1)
				<?php for($j=11;$j<count($table[$i]);$j++) :?>
					<td><?php echo number_format($table[$i][$j],2,'.',','); ?></td>
				<?php endfor ?>
				@else
					<td><?php echo number_format($table[$i][14+$type],2,'.',','); ?></td>
				<?php for($j=24;$j<count($table[$i]);$j++) :?>
					<td><?php echo number_format($table[$i][$j],2,'.',','); ?></td>
				<?php endfor ?>
				@endif
			</tr>
		<?php endfor ?>
		<tr>
		<th>Total</th>
		<td></td>
		@for($i =0;$i<11;$i++)
			@if($i<6 || $i>8)
				<td>{{number_format($total1[$i],2,'.',',')}} </td>
			@else
				<td class="disabled"></td>
			@endif
		@endfor
		@if($type==1)
		@for($i=11;$i<count($total1);$i++)
			<td>{{number_format($total1[$i],2,'.',',')}}</td>
		@endfor
		@else
			<td>{{number_format($total1[14+$type],2,'.',',')}}</td>
			@for($i=24;$i<count($total1);$i++)
				<td>{{number_format($total1[$i],2,'.',',')}}</td>
			@endfor
		@endif
		</tr>
	</table>
    </div>
	<br/>

	<h5><strong>ตาม Sevice/OH/อื่น ๆ</strong></h5>
	<div class="table-responsive">
	<table class="table table-bordered scroll3">
		<thead>
			<th style="width:50%">รายการ</th>
			<th style="width:8%">ภาควิชา</th>
			<?php for($j=0;$j<count($income_types);$j++) :?>
				<th style="width:8%"><?php echo $income_types[$j]->name; ?></th>
			<?php endfor ?>
			<th> Total</th>
			@if($type==1)
			<th class="danger"> Fund</th>
			<th class="danger"> ENG</th>
			<th class="danger"> Lib</th>
			<th class="danger"> Depart</th>
			<th class="danger"> Total</th>
			<?php for($i=1;$i<count($departments)-1;$i++) :?>
				<th class="success">{{$departments[$i]->name}}</th>
			<?php endfor;?>
			@else
				<th class="success">{{$departments[$type-1]->name}}</th>
			@endif
			<th class="success"> ENG</th>
			<th class="success"> Fund</th>
			<th class="success"> Lib</th>
			<th class="success"> Total</th>
		</thead>
		<?php for($i=0;$i<count($table2);$i++) :?>
			<tr>
				<td><?php echo $course_name2[$i][0]; ?></td>
				<td>
					{{ $departments[$course_name2[$i][1]]->name }}
				</td>
				@for($j=0;$j<11;$j++)
					@if(($j>5&&$j<9)||$j==10)
						<td>{{number_format($table2[$i][$j],2,'.',',')}}</td>
					@else
						<td class="disabled"></td>
					@endif
				@endfor
				@if($type==1)
				<?php for($j=11;$j<count($table2[$i]);$j++) :?>
					<td><?php echo number_format($table2[$i][$j],2,'.',','); ?></td>
				<?php endfor ?>
				@else
					<td><?php echo number_format($table2[$i][14+$type],2,'.',','); ?></td>
				<?php for($j=24;$j<count($table2[$i]);$j++) :?>
					<td><?php echo number_format($table2[$i][$j],2,'.',','); ?></td>
				<?php endfor ?>
				@endif
			</tr>
		<?php endfor ?>
		<tr>
			<th>Total</th>
			<td></td>		
			@for($j=0;$j<11;$j++)
				@if(($j>5&&$j<9)||$j==10)
					<td>{{number_format($total2[$j],2,'.',',')}}</td>
				@else
					<td class="disabled"></td>
				@endif
			@endfor
			@if($type==1)
			@for($i=11;$i<count($total2);$i++)
				<td>{{number_format($total2[$i],2,'.',',')}}</td>
			@endfor
			@else
				<td>{{number_format($total2[14+$type],2,'.',',')}}</td>
				@for($i=24;$i<count($total2);$i++)
					<td>{{number_format($total2[$i],2,'.',',')}}</td>
				@endfor
			@endif
		</tr>
	</table>
	</div>
	<br/>
	<!--  -->

	<br/>
	<h5><strong>ค่าจัดสรรค่าธรรมเนียม จากคณะอื่น</strong></h5>
	<div class="table-responsive">
	<table class="table table-bordered table-responsive scroll4">
		<thead>
			<th style="width:40%">รายการ</th>
			<th style="width:8%">ภาควิชา</th>
			<?php for($j=0;$j<count($income_types);$j++) :?>
				<th style="width:8%"><?php echo $income_types[$j]->name; ?></th>
			<?php endfor ?>
			<th> Total</th>
			@if($type==1)
			<th class="danger"> Fund</th>
			<th class="danger"> ENG</th>
			<th class="danger"> Lib</th>
			<th class="danger"> Depart</th>
			<th class="danger"> Total</th>
			<?php for($i=1;$i<count($departments)-1;$i++) :?>
				<th class="success">{{$departments[$i]->name}}</th>
			<?php endfor;?>
			@else
				<th class="success">{{$departments[$type-1]->name}}</th>
			@endif
			<th class="success"> ENG</th>
			<th class="success"> Fund</th>
			<th class="success"> Lib</th>
			<th class="success"> Total</th>
		</thead>
		<?php for($i=0;$i<count($table3);$i++) :?>
			<tr>
				<td><?php echo $course_name3[$i][0]; ?></td>
				<td>
					{{ $departments[$course_name3[$i][1]]->name }}
				</td>
				@for($j=0;$j<11;$j++)
					@if($j==0 || $j>8)
						<td>{{number_format($table3[$i][$j],2,'.',',')}}</td>
					@else
						<td class="disabled"></td>
					@endif
				@endfor
				@if($type==1)
				<?php for($j=11;$j<count($table3[$i]);$j++) :?>
					<td><?php echo number_format($table3[$i][$j],2,'.',','); ?></td>
				<?php endfor ?>
				@else
					<td><?php echo number_format($table3[$i][14+$type],2,'.',','); ?></td>
				<?php for($j=24;$j<count($table3[$i]);$j++) :?>
					<td><?php echo number_format($table3[$i][$j],2,'.',','); ?></td>
				<?php endfor ?>
				@endif
			</tr>
		<?php endfor ?>
		<tr>
			<th>Total</th>
			<td></td>
			@for($j=0;$j<11;$j++)
				@if($j==0 || $j>8)
					<td>{{number_format($total3[$j],2,'.',',')}}</td>
				@else
					<td class="disabled"></td>
				@endif
			@endfor
			@if($type==1)
				@for($i=11;$i<count($total3);$i++)
					<td>{{number_format($total3[$i],2,'.',',')}}</td>
				@endfor
				@else
				<td>{{number_format($total3[14+$type],2,'.',',')}}</td>
				@for($i=24;$i<count($total3);$i++)
					<td>{{number_format($total3[$i],2,'.',',')}}</td>
				@endfor
			@endif
		</tr>
	</table>
	</div>
	<br/>
	<script>
	$(document).ready(function(){
		$('#select_year').val("{{$semester.'/'.$year}}");
		var $table1 = $('.table.scroll1');
		var w1  = $table1.find('th:first-child').width();
		//alert($table1.find('th:first-child').width());

		var $fixedColumn1 = $table1.clone().insertBefore($table1).addClass('fixed-column');
		$fixedColumn1.find('th:not(:first-child),td:not(:first-child)').remove();

		$fixedColumn1.find('tr').each(function (i, elem) {
	    	$(this).height($table1.find('tr:eq(' + i + ')').height());
		});
		$fixedColumn1.find('th,td').each(function (i, elem) {
	    	$(this).width(w1);
		});

		var $table2 = $('.table.scroll2');
		var w2  = $table2.find('th:first-child').width();
		//alert($table2.find('th:first-child').width());

		var $fixedColumn2 = $table2.clone().insertBefore($table2).addClass('fixed-column');
		$fixedColumn2.find('th:not(:first-child),td:not(:first-child)').remove();

		$fixedColumn2.find('tr').each(function (i, elem) {
	    	$(this).height($table2.find('tr:eq(' + i + ')').height());
		});
		$fixedColumn2.find('th,td').each(function (i, elem) {
	    	$(this).width(w2);
		});

		var $table3 = $('.table.scroll3');
		var w3  = $table3.find('th:first-child').width();
		//alert($table3.find('th:first-child').width());

		var $fixedColumn3 = $table3.clone().insertBefore($table3).addClass('fixed-column');
		$fixedColumn3.find('th:not(:first-child),td:not(:first-child)').remove();

		$fixedColumn3.find('tr').each(function (i, elem) {
	    	$(this).height($table3.find('tr:eq(' + i + ')').height());
		});
		$fixedColumn3.find('th,td').each(function (i, elem) {
	    	$(this).width(w3);
		});

		var $table4 = $('.table.scroll4');
		var w4  = $table4.find('th:first-child').width();
		//alert($table4.find('th:first-child').width());

		var $fixedColumn4 = $table4.clone().insertBefore($table4).addClass('fixed-column');

		$fixedColumn4.find('th:not(:first-child),td:not(:first-child)').remove();
		$fixedColumn4.find('tr').each(function (i, elem) {
	    	$(this).height($table4.find('tr:eq(' + i + ')').height());
		});
		$fixedColumn4.find('th,td').each(function (i, elem) {
	    	$(this).width(w4);
		});



		});
	$('#select_year').change(function(){
		var value = $(this).val();
		window.location.href = "{{url('report/semester')}}/"+value;
	});

	</script>
@stop

