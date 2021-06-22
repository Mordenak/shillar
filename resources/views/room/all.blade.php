@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div class="dt-container">
	<div>
		<form method="get" action="/room/create">
			<div class="form-group row">
				<div class="col-md-3">
					<input type="submit" value="Add Room" class="form-control btn btn-success">
				</div>
			</div>
		</form>
	</div>
	@if ($rooms)
	<table id="all-records">
		<thead>
			<th>ID</th>
			<th>Title</th>
			<th>Zone Name</th>
		</thead>
		<tbody>
			@foreach ($rooms as $room)
			<tr>
				<td>{{$room->id}}</td>
				<td><a href="/room/edit/{{$room->id}}">{{$room->title ? $room->title : ' -- No Title -- '}}</a></td>
				<td>{{$room->zone()->name}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
</div>

@endsection