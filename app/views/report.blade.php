@extends('layout')

@section('content')

<?php 
	$year 	      = $arr['year'];
	$semester  	  = $arr['semester'];
	$income_types = $arr['income_types'];
	
	$table        = $arr['table'];
	$course_name  = $arr['course_name'];

	$table2        = $arr['table2'];
	$course_name2  = $arr['course_name2'];

	$departments = $arr['departments'];
?>    

	<h4>รายงาน <?php echo $semester."/".$year ; ?></h4>
	<hr>
	<h5><strong>ตามหลักสูตร</strong></h5>
	<table class="table table-bordered">
		<thead>
			<th style="width:20%">หลักสูตร</th>
			<th style="width:8%">ภาควิชา</th>
			<?php for($j=0;$j<count($income_types);$j++) :?>
				<th style="width:8%"><?php echo $income_types[$j]->name; ?></th>
			<?php endfor ?>
		</thead>
		<?php for($i=0;$i<count($table);$i++) :?>
			<tr>
				<td><?php echo $course_name[$i][0]; ?></td>
				<td>
					@if($course_name[$i][1] == 0)
						-
					@else
						{{ $departments[$course_name[$i][1]]->name }}
					@endif
				</td>
				<?php for($j=0;$j<count($income_types)-3;$j++) :?>
					<td><?php echo $table[$i][$j]; ?></td>
				<?php endfor ?>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
			</tr>
		<?php endfor ?>
	</table>

	<br/>
	<h5><strong>ตาม Sevice/OH/อื่น ๆ</strong></h5>
	<table class="table table-bordered">
		<thead>
			<th style="width:20%">รายการ</th>
			<th style="width:8%">ภาควิชา</th>
			<?php for($j=0;$j<count($income_types);$j++) :?>
				<th style="width:8%"><?php echo $income_types[$j]->name; ?></th>
			<?php endfor ?>
		</thead>
		<?php for($i=0;$i<count($table2);$i++) :?>
			<tr>
				<td><?php echo $course_name2[$i][0]; ?></td>
				<td>
					@if($course_name2[$i][1] == 0)
						{{ "Eng" }}
					@else
						{{ $departments[$course_name2[$i][1]-1]->name }}
					@endif
				</td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<?php for($j=6;$j<9;$j++) :?>
					<td><?php echo $table2[$i][$j]; ?></td>
				<?php endfor ?>
				
			</tr>
		<?php endfor ?>
	</table>
@stop

