@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

@if ($users)
<table id="all-records">
	<thead>
		<th>ID</th>
		<th>User Name</th>
		<th>Email</th>
		<th>Created On</th>
		<th>Admin Level</th>
	</thead>
	<tbody>
		@foreach ($users as $user)
		<tr>
			<td>{{$user->id}}</td>
			<td><a href="/user/edit/{{$user->id}}">{{$user->name}}</a></td>
			<td>{{$user->email}}</td>
			<td>{{$user->created_at}}</td>
			<td>{{$user->admin_level}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endif

@endsection