@extends('layout')

@section('content')
	<h4>Welcome {{$name = Auth::user()->name}}</h4>
	<hr>

@stop