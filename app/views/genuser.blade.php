@extends('layout')

@section('content')
<h4>Gen User</h4>
<hr>
<form method="post" action="genuser" class="form-horizontal">
	<div class="form-group">
		<label for="username" class="col-sm-2">Username: </label>
		<div class="col-md-9">
			<input type="text" name="username" id="username" value="" class="form-control">
		</div>
		<div class="col-md-1">
			<input type="button" value="Check Username" class="btn btn-primary" onclick="checkusername()"> 
			<div id=checkvalue></div>
		</div>
	</div>
	<div class="form-group">
		<label for="password" class="col-sm-2">Password: </label>
		<div class="col-md-10">
			<input type="password" name="password" id="password" value="" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="name" class="col-sm-2">Full Name: </label>
		<div class="col-md-10">
			<input type="text" name="name" id="name" value="" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="usertype" class="col-sm-2">User Type: </label>
		<div class="col-md-10">
			<select name="usertype" id="usertype" class="form-control">
				@foreach($usertype as $usertype)
					<option value="{{ $usertype->id }}">{{ $usertype->type }}</option>
				@endforeach
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-2"></div>
		<div class="col-md-10"><input type="submit" id="submit" name="submit" class="btn btn-primary" value="Submit" disabled></div>
	</div>
</form>

<script>

			function checkusername(){
				var username	= document.getElementById("username").value;
				
				$.post( "checkusername", 
					{ 
						username: username
					})
				.done(function( data ) {
					if(data.length > 0){
						console.log(data);
						alert("ไม่สามารถใช้ username นี้ได้");
						
					}
					else
					{
						document.getElementById("submit").disabled = false;
					}
				});
			}

			$('form').submit(function () {

				// Get the Login Name value and trim it
				var password = $.trim($('#password').val());

				// Check if empty of not
				if (password  === '') {
					alert('กรุณากรอก password');
					return false;
				}
								
				var name = $.trim($('#name').val());

				// Check if empty of not
				if (name  === '') {
					alert('กรุณากรอก name');
					return false;
				}
			});

			
	</script>
@stop