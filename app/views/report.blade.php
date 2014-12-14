@extends('layout')

@section('content')

<?php 
	$year 	      = $arr['year'];
	$semester  	  = $arr['semester'];
	$income_types = $arr['income_types'];
	$table        = $arr['table'];
	$course_name  = $arr['course_name'];
?>    

	<h4>รายงาน <?php echo $semester."/".$year ; ?></h4>
	<hr>
	<h5><strong>ตามหลักสูตร</strong></h5>
	<table class="table table-bordered">
		<thead>
			<th>หลักสูตร</th>
			<?php for($j=0;$j<count($income_types);$j++) :?>
				<th><?php echo $income_types[$j]->name; ?></th>
			<?php endfor ?>
		</thead>
		<?php for($i=0;$i<count($table);$i++) :?>
			<tr>
				<td><?php echo $course_name[$i]; ?></td>

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
			<th>รายการ</th>
			<?php for($j=0;$j<count($income_types);$j++) :?>
				<th><?php echo $income_types[$j]->name; ?></th>
			<?php endfor ?>
		</thead>
		<?php for($i=0;$i<count($table);$i++) :?>
			<tr>
				<td><?php echo $course_name[$i]; ?></td>

				<?php for($j=0;$j<count($income_types)-3;$j++) :?>
					<td><?php echo $table[$i][$j]; ?></td>
				<?php endfor ?>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
			</tr>
		<?php endfor ?>
	</table>
@stop

