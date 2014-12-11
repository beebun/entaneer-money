@extends('layout')

@section('content')

    
	<h4>Add Expenditure1</h4>
	<form method="post" action="expenditure1">
		
		Department: 
		<select name="Department" id="Department" onchange="setAmount()">
			@foreach($departments as $department)
				<option value="{{ $department->id }}">{{ $department->name }}</option>
			@endforeach
		</select>
		<br><br>

		Years: 
		<select name="Years" id="Years" class="Years" onchange="setAmount()">
			<option value="2558">2558</option>
			<option value="2557">2557</option>
			<option value="2556">2556</option>
			<option value="2555">2555</option>
			<option value="2554">2554</option>
			<option value="2553">2553</option>
		</select>
		<br><br>
		
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


		
		Amount: <input type="text" name="Amount" value="">
		<br><br>

		<input type="submit" name="submit" value="Submit">
	</form>
@stop

