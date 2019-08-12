@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

@if ($rooms)
<table id="all-rooms">
	<thead>
		<th>ID</th>
		<th>Title</th>
		<th>Zone Name</th>
	</thead>
	<tbody>
		@foreach ($rooms as $room)
		<tr>
			<td>{{$room->id}}</td>
			<td><a href="/room/edit/{{$room->id}}">{{$room->title}}</a></td>
			<td>{{$room->zone()->name}}</td>
		</tr>
		@endforeach
	</tbody>
</table>

<script>
$('#all-rooms').dataTable();
</script>
@endif

@endsection