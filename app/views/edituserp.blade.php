@extends('layout')

@section('content')
	<h4>Edit User : {{ $users[$id]->username }}</h4>
	<hr>
<form method="post" action="../edituserp/{{$id}}" class="form-horizontal">
	<div class="form-group">
		<label for="username" class="col-sm-2">Username: </label>
		<div class="col-md-10">
			<input type="text" name="username" id="username" value="{{ $users[$id-1]->username }}" class="form-control" disabled>
		</div>
	</div>
	<div class="form-group">
		<label for="password" class="col-sm-2">Password: </label>
		<div class="col-md-10">
			<input type="password" name="password" id="password" value="{{ $users[$id-1]->password }}" class="form-control">
		</div>
	</div>
		<div class="form-group">
		<label for="retype-password" class="col-sm-2">Retype-Password: </label>
		<div class="col-md-10">
			<input type="password" name="retype-password" id="retype-password" value="{{ $users[$id-1]->password }}" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="name" class="col-sm-2">Full Name: </label>
		<div class="col-md-10">
			<input type="text" name="name" id="name" value="{{ $users[$id-1]->name }}" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="usertype" class="col-sm-2">User Type: </label>
		<div class="col-md-10">
			<select name="usertype" id="usertype" class="form-control" disabled>
				@foreach($usertype as $usertype)
					@if ($usertype->id == $users[$id-1]->type)
						<option value="{{ $usertype->id }}" selected="selected">
							{{ $usertype->type }}
						</option>
					@else
						<option value="{{ $usertype->id }}">
							{{ $usertype->type }}
						</option>
					@endif
				@endforeach
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-2"></div>
		<div class="col-md-10"><input type="submit" id="submit" name="submit" class="btn btn-primary" value="Submit" ></div>
	</div>
</form>

<script>


			function checkusername(){
				var username	= document.getElementById("username").value;
				if(username!=""){
					$.post( "../checkusername", 
						{ 
							username: username
						})
					.done(function( data ) {
						if(data.length > 0){
							//console.log(data);
							alert("ไม่สามารถใช้ username นี้ได้");
							document.getElementById("submit").disabled = true;
						}
						else
						{
							alert("สามารถใช้ username นี้ได้");
							document.getElementById("submit").disabled = false;
						}
					});
				}
				else
				{
					alert('กรุณากรอก username');
					document.getElementById("submit").disabled = true;
				}
				
			}

			$('#username').change(function () {
				var username     = document.getElementById("username").value;
				if( username != "{{ $users[$id-1]->username }}")
				{
					//alert('change');
					document.getElementById("submit").disabled = true;
				}
				else 
				{
					document.getElementById("submit").disabled = false;
				}
			});
			
			$('form').submit(function () {

				// Get the Login Name value and trim it
				var password = $.trim($('#password').val());
				var repassword = $.trim($('#retype-password').val());

				// Check if empty of not
				if (password  == '') {
					alert('กรุณากรอก password');
					return false;
				}
				
				if (password.length < 6) {
					alert('กรุณาตั้งรหัสตั้งแต่ 6 ตัวขึ้นไป');
					return false;
				}
				
				if (password  != repassword) {
					alert('กรุณากรอก password ให้ตรงกัน');
					return false;
				}
								
				var name = $.trim($('#name').val());

				// Check if empty of not
				if (name  == '') {
					alert('กรุณากรอก name');
					return false;
				}
			});

			
	</script>
@stop