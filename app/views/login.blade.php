@extends('layout')

@section('content')
<h4>Login</h4>
<hr>
<form method="post" action="login" class="form-horizontal">
	<div class="form-group">
		<label for="username" class="col-sm-2">Username: </label>
		<div class="col-md-10">
			<input type="text" name="username" id="username" value="" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="password" class="col-sm-2">Password: </label>
		<div class="col-md-10">
			<input type="password" name="password" id="password" value="" class="form-control">
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-2"></div>
		<div class="col-md-10"><input type="submit" name="submit" class="btn btn-primary" value="Login"></div>
	</div>
</form>

@stop