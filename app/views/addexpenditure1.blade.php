@extends('layout')

@section('content')

    
	<h4>Edit Expenditure1</h4>
	<hr>
	<form method="post" action="expenditure1" class="form-horizontal">
		<div class="form-group">
			<label for="Department" class="col-sm-2">ภาควิชา: </label>
			<div class="col-md-10">
			<select name="Department" id="Department" class="form-control">
				@foreach($departments as $department)
					<option value="{{ $department->id }}">{{ $department->name }}</option>
				@endforeach
			</select>
			</div>
		</div>

		<div class="form-group">
			<label for="Years" class="col-sm-2">ปีการศึกษา: </label>
			<div class="col-md-10">
				<select name="Years" id="Years" class="Years form-control" >
					<option value="2558">2558</option>
					<option value="2557">2557</option>
					<option value="2556">2556</option>
					<option value="2555">2555</option>
					<option value="2554">2554</option>
					<option value="2553">2553</option>
				</select>
			</div>
		</div>
		


		<div class="form-group">
			<label for="Amount" class="col-sm-2">ยอดเงิน: </label>
			<div class="col-md-10">
				<input type="text" name="Amount" id="amount" value="" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label for="Amount" class="col-sm-2">รายละเอียด: </label>
			<div class="col-md-10">
				<textarea style="height:200px" class="form-control" id="detail" name="Detail"></textarea>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-2"></div>
			<div class="col-md-10"><input type="submit" name="submit" class="btn btn-primary" value="บันทึก"></div>
		</div>
	</form>


	<script>


			function get_saved_amount(){
				var Years = document.getElementById("Years").value;
				var Department = document.getElementById("Department").value;
				//alert( Years+" "+Department);
				
				$.post( "getAmount", { Years: Years, Department: Department }).done(function( data ) {
					if(data.length > 0){
						$('#amount').val(data[0].amount);
						$('#detail').val(data[0].detail);
					}else{
						$('#amount').val(0);
					}
				});
			}

			get_saved_amount();
			
			$( "select" ).change(function() {
				get_saved_amount();	
			});
			
		</script>
@stop

