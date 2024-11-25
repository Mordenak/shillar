@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

@if ($characters)
<table id="all-records">
	<thead>
		<th>ID</th>
		<th>Name</th>
		<th>Created On</th>
		<th>User</th>
	</thead>
	<tbody>
		@foreach ($characters as $character)
		<tr>
			<td>{{$character->id}}</td>
			<td><a href="/character/edit/{{$character->id}}">{{$character->name}}</a></td>
			<td>{{$character->created_at}}</td>
			<td><a href="/user/edit/{{$character->users_id}}">{{$character->user()->name}}</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
@endif

@endsection