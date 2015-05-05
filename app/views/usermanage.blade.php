@extends('layout')

@section('content')

	<h4>Welcome {{$name = Auth::user()->name}}</h4>
	<hr>
	<h5>List Name</h5>
	
	<table class="table table-bordered">
		<thead>
			<th>UserName</th>
			<th>Name</th>
			<th>Type</th>
			<th><a href="genuser" class="btn btn-primary">Generate User</a></th>
		</thead>
		@foreach($users as $user)
		<tr>
			<td>{{ $user->username }}</td>
			<td>{{ $user->name }}</td>
			<td>{{ $usertype[($user->type-1)]->type}}</td>
			<td>
				@if ($user->type != 1)
				<a href="{{ route('edituser', array('id' => $user->id)) }}">
				<button type="button" class="btn btn-default" ">
				  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</button>
				</a>
				<button type="button" class="btn btn-default" onclick="chkdeleteuser({{$user->id}})">
				  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
				@else
				<a href="{{ route('edituser', array('id' => $user->id)) }}">
				<button type="button" class="btn btn-default" >
				  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</button>
				</a>
				@endif
			</td>
		</tr>
		@endforeach

	</table>
    
<script>

function chkdeleteuser(id) {
    if (confirm("You want to delete this user?") == true) {
        deleteuser(id);
    } else {
        
    }
}

	
			function deleteuser(id){
				//alert("test "+id);

				$.post( "deleteuser", 
					{ 
						id: id
					})
				.done(function( data ) {
					if(data.length > 0){
						//alert("ไม่สามารถใช้ username นี้ได้");
						location.reload();
					}
					else
					{
						//alert("สามารถใช้ username นี้ได้");
					}
				});
			}
				
		
			
	</script>



@stop