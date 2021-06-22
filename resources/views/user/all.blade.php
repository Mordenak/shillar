@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

@if ($users)
<table id="all-records">
	<thead>
		<th>ID</th>
		<th>Record</th>
		<th>User Name</th>
	</thead>
	<tbody>
		@foreach ($users as $user)
		<tr>
			<td>{{$user->id}}</td>
			<td><a href="/user/edit/{{$user->id}}">{{$user->name}}</a></td>
			<td>{{$user->name}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endif

@endsection