@extends('layout')

@section('content')
	<h4>Welcome {{$name = Auth::user()->name}} 
				<a href="{{ route('edituser', array('id' => $id = Auth::user()->id)) }}">
				<button type="button" class="btn btn-default" >
				  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</button>
				</a></h4>
	<hr>

@stop