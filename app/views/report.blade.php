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
	<h4>รายงาน <?php echo $semester."/".$year ; ?></h4>`
	<hr>
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
	<h5><strong>ตามหลักสูตร</strong></h5>
	<div>

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
	<div>
		<table class="table table-bordered">
		<thead>
			<th style="width:200px">หลักสูตร</th>
			<th style="width:8%">ภาควิชา</th>
			<th class="danger"> Fund</th>
			<th class="danger"> ENG</th>
			<th class="danger"> Lib</th>
			<th class="danger"> Depart</th>
			<th class="danger"> Total</th>
			<?php for($i=1;$i<count($departments)-1;$i++) :?>
				<th class="success">{{$departments[$i]->name}}</th>
			<?php endfor;?>
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
				<?php for($j=11;$j<count($table[$i]);$j++) :?>
					<td><?php echo $table[$i][$j]; ?></td>
				<?php endfor ?>
			</tr>
		<?php endfor ?>
		<tr>
		<th>Total</th>
		<td></td>
		@for($i=11;$i<count($total1);$i++)
			<td>{{$total1[$i]}}</td>
		@endfor
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
	<table class="table table-bordered table-responsive">
		<thead>
			<th style="width:50%">หลักสูตร</th>
			<th style="width:8%">ภาควิชา</th>
			<th class="danger"> Fund</th>
			<th class="danger"> ENG</th>
			<th class="danger"> Lib</th>
			<th class="danger"> Depart</th>
			<th class="danger"> Total</th>
			<?php for($i=1;$i<count($departments)-1;$i++) :?>
				<th class="success">{{$departments[$i]->name}}</th>
			<?php endfor;?>
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
				@for($j=11;$j<count($table2[$i]);$j++)
					<td>{{$table2[$i][$j]}}</td>
				@endfor
			</tr>
		<?php endfor ?>
		<tr>
			<th>Total</th>
			<td></td>
			<?php for($i=11;$i<count($total2);$i++) :?>
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
	<table class="table table-bordered table-responsive">
		<thead>
			<th style="width:50%">หลักสูตร</th>
			<th style="width:8%">ภาควิชา</th>
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
		<?php for($i=0;$i<count($table3);$i++) :?>
			<tr>
				<td><?php echo $course_name3[$i][0]; ?></td>
				<td>
				{{ $departments[$course_name3[$i][1]]->name }}
				</td>
				@for($j=11;$j<count($table3[$i]);$j++)
					<td>{{$table3[$i][$j]}}</td>
			@endfor
			</tr>
		<?php endfor ?>
		<tr>
		<th>Total</th>
		<td></td>
			@for($j=11;$j<count($total3);$j++)
				<td>{{$total3[$j]}}</td>
			@endfor
		</tr>
	</table>
	<script>
	$('#scroller table').each(function(){
    var table = $(this),
        fixedCol = table.clone(true),
        fixedWidth = table.find('th').eq(0).width(),

        tablePos = table.position();
		//alert(fixedWidth);
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

