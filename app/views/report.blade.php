@extends('layout')

@section('content')

<?php 
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
		<option>1/2557</option>
		<option>2/2557</option>
		<option>1/2558</option>
	</select>
  </div>
</form>
	<h4>รายงาน <?php echo $semester."/".$year ; ?></h4>
	
	<hr>
	@if($type ==1)
	<table class="table table-bordered">
		<thead>
			<th>
			@for($i=0;$i<count($income_types);$i++)
				<th style="width:8%"><?php echo $income_types[$i]->name; ?></th>
			@endfor
			<th>Total</th>
		</thead>
		<tr>
			<th>Total </th>
			@for($i=0;$i<11;$i++)
				<td>{{$total[$i]}}</td>
			@endfor
		</tr>	
	</table>
	<table class="table table-bordered">
		<thead>
			<th>
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
			@for($i=11;$i<count($total);$i++)
				<td>{{$total[$i]}}</td>
			@endfor
		</tr>
	</table>
	@endif
	<h5><strong>ตามหลักสูตร</strong></h5>
	<div>

	<table class="table table-bordered">
		<thead>
			<th style="width:20%">หลักสูตร</th>
			<th style="width:8%">ภาควิชา</th>
			<?php for($j=0;$j<count($income_types);$j++) :?>
				<th style="width:8%"><?php echo $income_types[$j]->name; ?></th>
			<?php endfor ?>
			<th> Total</th>
		</thead>
		<?php for($i=0;$i<count($table);$i++) :?>
			<tr>
				<td><?php echo $course_name[$i][0]; ?></td>
				<td>
				{{ $departments[$course_name[$i][1]]->name }}
				</td>
				@for($j=0;$j<11;$j++)
				@if($j<6 || $j>8)
					<td>{{$table[$i][$j]}}</td>
				@else
					<td class="disabled"></td>
				@endif
				@endfor
			</tr>
		<?php endfor ?>
		<tr>
		<th>Total</th>
		<td></td>
		@for($i =0;$i<11;$i++)
			@if($i<6 || $i>8)
				<td>{{$total1[$i]}} </td>
			@else
				<td class="disabled"></td>
			@endif
		@endfor
		</tr>
	</table>
    </div>
	<br/>
	<div class="table-responsive">
		<table class="table table-bordered table-condensed">
		<thead>
		<tr>
			<th style="width:20%">หลักสูตร</th>
			<th >ภาควิชา</th>
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
	    </tr>
		</thead>
		<tbody>
		<?php for($i=0;$i<count($table);$i++) :?>
			<tr>
				<td><?php echo $course_name[$i][0]; ?></td>
				<td>
				{{ $departments[$course_name[$i][1]]->name }}
				</td>
				@if($type==1)
				<?php for($j=11;$j<count($table[$i]);$j++) :?>
					<td><?php echo $table[$i][$j]; ?></td>
				<?php endfor ?>
				@else
					<td><?php echo $table[$i][14+$type]; ?></td>
				<?php for($j=24;$j<count($table[$i]);$j++) :?>
					<td><?php echo $table[$i][$j]; ?></td>
				<?php endfor ?>
				@endif
			</tr>
		<?php endfor ?>
		<tr>
		<th>Total</th>
		<td></td>
		@if($type==1)
		@for($i=11;$i<count($total1);$i++)
			<td>{{$total1[$i]}}</td>
		@endfor
		@else
			<td>{{$total1[14+$type]}}</td>
			@for($i=24;$i<count($total1);$i++)
				<td>{{$total1[$i]}}</td>
			@endfor
		@endif
		</tr>
		</tbody>
	</table>
	</div>
	<br/>
	<h5><strong>ตาม Sevice/OH/อื่น ๆ</strong></h5>
	<table class="table table-bordered table-responsive">
		<thead>
			<th style="width:50%">รายการ</th>
			<th style="width:8%">ภาควิชา</th>
			<?php for($j=0;$j<count($income_types);$j++) :?>
				<th style="width:8%"><?php echo $income_types[$j]->name; ?></th>
			<?php endfor ?>
			<th> Total</th>
		</thead>
		<?php for($i=0;$i<count($table2);$i++) :?>
			<tr>
				<td><?php echo $course_name2[$i][0]; ?></td>
				<td>
					{{ $departments[$course_name2[$i][1]]->name }}
				</td>
				@for($j=0;$j<11;$j++)
					@if(($j>5&&$j<9)||$j==10)
						<td>{{$table2[$i][$j]}}</td>
					@else
						<td class="disabled"></td>
					@endif
				@endfor
			</tr>
		<?php endfor ?>
		<tr>
			<th>Total</th>
			<td></td>		
			@for($j=0;$j<11;$j++)
				@if(($j>5&&$j<9)||$j==10)
					<td>{{$total2[$j]}}</td>
				@else
					<td class="disabled"></td>
				@endif
			@endfor
		</tr>
	</table>

	<br/>
	<table class="table table-bordered">
		<thead>
			<th style="width:50%">หลักสูตร</th>
			<th style="width:8%">ภาควิชา</th>
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
				@if($type==1)
				<?php for($j=11;$j<count($table2[$i]);$j++) :?>
					<td><?php echo $table2[$i][$j]; ?></td>
				<?php endfor ?>
				@else
					<td><?php echo $table2[$i][14+$type]; ?></td>
				<?php for($j=24;$j<count($table2[$i]);$j++) :?>
					<td><?php echo $table2[$i][$j]; ?></td>
				<?php endfor ?>
				@endif
			</tr>
		<?php endfor ?>
		<tr>
			<th>Total</th>
			<td></td>
			@if($type==1)
		@for($i=11;$i<count($total2);$i++)
			<td>{{$total2[$i]}}</td>
		@endfor
		@else
			<td>{{$total2[14+$type]}}</td>
			@for($i=24;$i<count($total2);$i++)
				<td>{{$total2[$i]}}</td>
			@endfor
		@endif
		</tr>
	</table>

	<br/>
	<h5><strong>ค่าจัดสรรค่าธรรมเนียม จากคณะอื่น</strong></h5>
	<table class="table table-bordered table-responsive">
		<thead>
			<th style="width:40%">รายการ</th>
			<th style="width:8%">ภาควิชา</th>
			<?php for($j=0;$j<count($income_types);$j++) :?>
				<th style="width:8%"><?php echo $income_types[$j]->name; ?></th>
			<?php endfor ?>
			<th> Total</th>
		</thead>
		<?php for($i=0;$i<count($table3);$i++) :?>
			<tr>
				<td><?php echo $course_name3[$i][0]; ?></td>
				<td>
					{{ $departments[$course_name3[$i][1]]->name }}
				</td>
				@for($j=0;$j<11;$j++)
					@if($j==0 || $j>8)
						<td>{{$table3[$i][$j]}}</td>
					@else
						<td class="disabled"></td>
					@endif
				@endfor
			</tr>
		<?php endfor ?>
		<tr>
			<th>Total</th>
			<td></td>
			@for($j=0;$j<11;$j++)
				@if($j==0 || $j>8)
					<td>{{$total3[$j]}}</td>
				@else
					<td class="disabled"></td>
				@endif
			@endfor
		</tr>
	</table>
	<br/>
	<table class="table table-bordered">
		<thead>
			<th style="width:50%">หลักสูตร</th>
			<th style="width:8%">ภาควิชา</th>
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
				@if($type==1)
				<?php for($j=11;$j<count($table3[$i]);$j++) :?>
					<td><?php echo $table3[$i][$j]; ?></td>
				<?php endfor ?>
				@else
					<td><?php echo $table3[$i][14+$type]; ?></td>
				<?php for($j=24;$j<count($table3[$i]);$j++) :?>
					<td><?php echo $table3[$i][$j]; ?></td>
				<?php endfor ?>
				@endif
			</tr>
		<?php endfor ?>
		<tr>
		<th>Total</th>
		<td></td>
			@if($type==1)
		@for($i=11;$i<count($total3);$i++)
			<td>{{$total3[$i]}}</td>
		@endfor
		@else
			<td>{{$total3[14+$type]}}</td>
			@for($i=24;$i<count($total3);$i++)
				<td>{{$total3[$i]}}</td>
			@endfor
		@endif
		</tr>
	</table>
	<script>
	$(document).ready(function(){
		$('#select_year').val("{{$semester.'/'.$year}}");
	});
	$('#select_year').change(function(){
		var value = $(this).val();
		window.location.href = "{{url('report/semester')}}/"+value;
	});

	var $table = $('.table.scroll');
var $fixedColumn = $table.clone().insertBefore($table).addClass('fixed-column');

$fixedColumn.find('th:not(:first-child),td:not(:first-child)').remove();

$fixedColumn.find('tr').each(function (i, elem) {
    $(this).height($table.find('tr:eq(' + i + ')').height());
});
	
	</script>
@stop

