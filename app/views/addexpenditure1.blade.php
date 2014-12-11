@extends('layout')

@section('content')

    
	<h4>Edit Expenditure1</h4>
	<hr>
	<form method="post" action="expenditure1" class="form-horizontal">
		<div class="form-group">
			<label for="Department" class="col-sm-2">ภาควิชา: </label>
			<div class="col-md-10">
			<select name="Department" id="Department" onchange="setAmount()" class="form-control">
				@foreach($departments as $department)
					<option value="{{ $department->id }}">{{ $department->name }}</option>
				@endforeach
			</select>
			</div>
		</div>

		<div class="form-group">
			<label for="Years" class="col-sm-2">ปีการศึกษา: </label>
			<div class="col-md-10">
				<select name="Years" id="Years" class="Years form-control" onchange="setAmount()">
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
				<input type="text" name="Amount" value="" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-2"></div>
			<div class="col-md-10"><input type="submit" name="submit" class="btn btn-primary" value="บันทึก"></div>
		</div>
	</form>


	<script>
			function setAmount() {
				var Years = document.getElementById("Years").value;
				var Department = document.getElementById("Department").value;
				

				//document.getElementById("demo").innerHTML = Years+Department;
			}
			
			$( "select" ).change(function() {
				var Years = document.getElementById("Years").value;
				var Department = document.getElementById("Department").value;
				//alert( Years+" "+Department);
				
				$.post( "getAmount", { Years: Years, Department: Department }).done(function( data ) {
					alert( "Data Loaded: " + data );
				});
				
				/*var AmountValue = $.ajax({
					url: "/laravel/MoneyAnalysis/public/test",
					type: "POST",
					data: {
							"Years": Years,
							"Department": Department
						  },
				});
				
				AmountValue.done(function (res, textStatus, jqXHR){
					if (res.status = "ok"){     
						console.log(res);
					}
				});*/

			});
			
		</script>
@stop

