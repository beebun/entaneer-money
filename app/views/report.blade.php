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
	
?>    

<style>
body{
	font-size: 12px;
}
#scroller {
    width: 100%;
    overflow-x: scroll;
}
#scroller table {
    /* just a quick hack to make the table overflow the containing div
       your method may differ */
    width: 200%;
}

#scroller .table.fixedCol {
    width: auto;
    position: absolute;
    /* below styles are specific for borderd Bootstrap tables
       to remove rounded corners on cloned table */
    -webkit-border-top-right-radius: 0px;
    -webkit-border-bottom-right-radius: 0px;
       -moz-border-radius-topright: 0px;
       -moz-border-radius-bottomright: 0px;
            border-top-right-radius: 0px;
            border-bottom-right-radius: 0px;
}
.table.fixedCol th,
.table.fixedCol td {
    /* background is set to white to hide underlaying column
       of original table */
    background: white;
}
</style>
	<h4>รายงาน <?php echo $semester."/".$year ; ?></h4>
	<hr>
	<h5><strong>ตามหลักสูตร</strong></h5>
	<div >
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
				<?php for($j=6;$j<8;$j++) :?>
					<td><?php echo $table[$i][$j]; ?></td>
				<?php endfor ?>
			</tr>
		<?php endfor ?>
		<tr>
		<th>Total</th>
		<td></td>
		<?php for($i=0;$i<count($income_types)-4;$i++) :?>
		<td><?php if(count($total1)>0) echo $total1[$i]; ?></td>
		<?php endfor ?>
		<td class="disabled"></td>
		<td class="disabled"></td>
		<td class="disabled"></td>
		<?php for($i=6;$i<8;$i++) :?>
			<td><?php if(count($total1)>0)echo $total1[$i]; ?></td>
		<?php endfor ?>
		</tr>
	</table>
    </div>
	<br/>
	<div id="scroller2">
		<table class="table table-bordered table-responsive">
		<thead>
			<th style="width:50%">หลักสูตร</th>
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
				<?php for($j=8;$j<count($table[$i]);$j++) :?>
					<td><?php echo $table[$i][$j]; ?></td>
				<?php endfor ?>
			</tr>
		<?php endfor ?>
		<tr>
		<th>Total</th>
		<td></td>
		<?php for($i=8;$i<count($total1);$i++) :?>
		<td><?php echo $total1[$i]; ?></td>
		<?php endfor ?>
		</tr>
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
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<?php for($j=6;$j<9;$j++) :?>
					<td><?php if(count($table2)>0) echo $table2[$i][$j]; ?></td>
				<?php endfor ?>
				<td class="disabled"></td>
				<td><?php if(count($table2)>0) echo $table2[$i][9]; ?></td>
			</tr>
		<?php endfor ?>
		<tr>
			<th>Total</th>
			<td></td>
			<td class="disabled"></td>
			<td class="disabled"></td>
			<td class="disabled"></td>
			<td class="disabled"></td>
			<td class="disabled"></td>
			<td class="disabled"></td>
			<?php for($i=6;$i<9;$i++) :?>
				<td><?php if(count($table2)>0) echo $total2[$i]; ?></td>
			<?php endfor ?>
			<td class="disabled"></td>
			<td><?php if(count($table2)>0) echo $total2[9]; ?></td>
		</tr>
	</table>

	<br/>
	<table class="table table-bordered table-responsive">
		<thead>
			<th style="width:50%">หลักสูตร</th>
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
		<?php for($i=0;$i<count($table2);$i++) :?>
			<tr>
				<td><?php echo $course_name2[$i][0]; ?></td>
				<td>
				{{ $departments[$course_name2[$i][1]]->name }}
				</td>
				<?php for($j=10;$j<count($table2[$i]);$j++) :?>
					<td><?php echo $table2[$i][$j]; ?></td>
				<?php endfor ?>
			</tr>
		<?php endfor ?>
		<tr>
		<th>Total</th>
			<td></td>
		<?php for($i=10;$i<count($total2);$i++) :?>
					<td><?php if(count($table2)>0) echo $total2[$i]; ?></td>
				<?php endfor ?>
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
				<td><?php echo $table3[$i][0]; ?></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td><?php echo $table3[$i][1]; ?></td>
				<td><?php echo $table3[$i][2]; ?></td>
			</tr>
		<?php endfor ?>
		<tr>
			<th>Total</th>
			<td></td>
			<td><?php if(count($table3)>0) echo $total3[0]; ?></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td class="disabled"></td>
				<td><?php if(count($table3)>0) echo $total3[1]; ?></td>
				<td><?php if(count($table3)>0) echo $total3[2]; ?></td>
		</tr>
	</table>
	<br/>
	<table class="table table-bordered table-responsive">
		<thead>
			<th style="width:50%">หลักสูตร</th>
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
		<?php for($i=0;$i<count($table3);$i++) :?>
			<tr>
				<td><?php echo $course_name3[$i][0]; ?></td>
				<td>
				{{ $departments[$course_name3[$i][1]]->name }}
				</td>
				<?php for($j=3;$j<count($table3[$i]);$j++) :?>
					<td><?php echo $table3[$i][$j]; ?></td>
				<?php endfor ?>
			</tr>
		<?php endfor ?>
		<tr>
		<th>Total</th>
		<td></td>
			<?php for($i=3;$i<count($total3);$i++) :?>
				<td><?php if(count($total3)>0) echo $total3[$i]; ?></td>
			<?php endfor ?>
		</tr>
	</table>
	<script>
	$('#scroller table').each(function(){
    var table = $(this),
        fixedCol = table.clone(true),
        fixedWidth = table.find('th').eq(0).width(),

        tablePos = table.position();
	alert(fixedWidth);
    // Remove all but the first column from the cloned table
    fixedCol.find('th').not(':eq(0)').remove();
    fixedCol.find('tbody tr').each(function(){
        $(this).find('td').not(':eq(0)').remove();
    });

    // Set positioning so that cloned table overlays
    // first column of original table
    fixedCol.addClass('fixedCol');
    fixedCol.css({
        left: tablePos.left,
        top: tablePos.top
    });

    // Match column width with that of original table
    fixedCol.find('th,td').css('width',fixedWidth+'px');

    $('#scroller').append(fixedCol);
});
	</script>
@stop

