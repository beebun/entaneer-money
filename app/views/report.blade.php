@extends('layout')

@section('content')

<?php 
	$year         = $arr['year'];
	$semester     = $arr['semester'];
	$income_types = $arr['income_types'];
	
	$table        = $arr['table'];
	$course_name  = $arr['course_name'];
	
	$table2       = $arr['table2'];
	$course_name2 = $arr['course_name2'];
	
	$table3       = $arr['table3'];
	$course_name3 = $arr['course_name3'];
	
	$departments  = $arr['departments'];
?>    

<style>
body{
	font-size: 12px;
}
</style>
	<h4>รายงาน <?php echo $semester."/".$year ; ?></h4>
	<hr>
	<h5><strong>ตามหลักสูตร</strong></h5>
	<table class="table table-bordered table-responsive">
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
				<?php for($j=0;$j<count($income_types)-4;$j++) :?>
					<td><?php echo $table[$i][$j]; ?></td>
				<?php endfor ?>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td><?php echo $table[$i][count($income_types)-4]; ?></td>
			</tr>
		<?php endfor ?>
	</table>

	<br/>

		<table class="table table-bordered table-responsive">
		<thead>
			<th style="width:20%">หลักสูตร</th>
			<th style="width:8%">ภาควิชา</th>
			<th> Fund</th>
			<th> ENG</th>
			<th> Lib</th>
			<th> Depart</th>
			<th> Total</th>
			<?php for($i=1;$i<count($departments)-1;$i++) :?>
				<th>{{$departments[$i]->name}}</th>
			<?php endfor;?>
			<th> ENG</th>
			<th> Fund</th>
			<th> Lib</th>
			<th> Total</th>

		</thead>
		<?php for($i=0;$i<count($table);$i++) :?>
			<tr>
				<td><?php echo $course_name[$i][0]; ?></td>
				<td>
				{{ $departments[$course_name[$i][1]]->name }}
				</td>
				<?php for($j=count($income_types)-3;$j<count($table[$i]);$j++) :?>
					<td><?php echo $table[$i][$j]; ?></td>
				<?php endfor ?>
				<td></td>
			</tr>
		<?php endfor ?>
	</table>
	<br/>
	<h5><strong>ตาม Sevice/OH/อื่น ๆ</strong></h5>
	<table class="table table-bordered table-responsive">
		<thead>
			<th style="width:20%">รายการ</th>
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
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<?php for($j=6;$j<9;$j++) :?>
					<td><?php echo $table2[$i][$j]; ?></td>
				<?php endfor ?>
				<td class="disabled"></td>
				<td></td>
			</tr>
		<?php endfor ?>
	</table>

	<br/>
	<h5><strong>ค่าจัดสรรค่าธรรมเนียม จากคณะอื่น</strong></h5>
	<table class="table table-bordered table-responsive">
		<thead>
			<th style="width:20%">รายการ</th>
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
				<td><?php echo $table3[$i]; ?></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td></td>
			</tr>
		<?php endfor ?>
	</table>
@stop

