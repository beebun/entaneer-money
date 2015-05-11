@extends('layout')

@section('content')
<h4>{{$course->name.' '.$semester.'/'.$year}}</h4>
<table class="table">
	<tr>
		<th>ลำดับ</th>
		<th>ภาควิชา</th>
		<th>รายละเอียด</th>
		<th width="20%">จำนวน</th>
		<th>ลบ</th>
	</tr>
	<?php $i = 1;?>
	@if(count($data)==0)
	<tr><td colspan="5" style="background:#999999"><strong>no data</strong></td></tr>
	@endif
	@foreach($data as $each)
	<tr>
		<td>{{$i}}</td>
		<td>{{$departments[$each->department]->name}}</td>
		<td>{{$each->detail}}</td>
		<td><input type="text" style="text-align:right" value="{{$each->amount}}" class="form-control" onchange="save_item({{$each->id}},this.value);"></td>
		<td><a id="del" href="{{url('report/delete-item').'/'.$each->id}}" class="btn btn-danger">ลบ</a></td>
		<?php $i++;?>
	</tr>
	@endforeach
	<tr>
		<th colspan="3">รวม</th>
		<td style="text-align:right"><span id="total">{{$total}}</span></td>
		<td></td>
	</tr>
</table>
<script>
	function save_item(id,value){
		$.post("{{url('report/save-item')}}", 
			{ 
				id:id,
				value:value,
			})
		.done(function( data ) {
			console.log(data);
			alert("บันทึกเรียบร้อย");
			$('#total').text(data);
		})
		.error(function(data) {
			alert("พบข้อผิดพลาด!!!");	
		});
	}
	$('#del').on('click',function(){
		return confirm('ต้องการลบข้อมูล?');
	})
</script>
@stop