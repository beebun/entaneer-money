@extends('layout')

@section('content')
	<h4>Welcome {{$name = Auth::user()->name}}</h4>
	<hr>
	<h5>List Name</h5>
    @foreach($users as $user)
        <p>{{ $user->id }} : {{ $user->name }}</p>
    @endforeach
@stop