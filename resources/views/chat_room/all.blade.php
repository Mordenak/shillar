@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div>
	<form method="get" action="/chat_room/create">
		<div class="form-group row">
			<div class="col-md-3">
				<input type="submit" value="Add Chat Room" class="btn btn-success">
			</div>
		</div>
	</form>
</div>

@if ($chat_rooms)
<table id="all-records">
	<thead>
		<th>ID</th>
		<th>Name</th>
		<th>Score Req</th>
	</thead>
	<tbody>
		@foreach ($chat_rooms as $chat_room)
		<tr>
			<td>{{$chat_room->id}}</td>
			<td><a href="/chat_room/edit/{{$chat_room->id}}">{{$chat_room->name}}</a></td>
			<td>{{$chat_room->score_req}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endif

@endsection 