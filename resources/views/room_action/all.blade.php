@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div>
	<form method="get" action="/room_action/create">
		<div class="form-group row">
			<div class="col-md-3">
				<input type="submit" value="Add Room Action" class="btn btn-success">
			</div>
		</div>
	</form>
</div>

@if ($room_actions)
<table id="all-room_actions">
	<thead>
		<th>ID</th>
		<th>Action UID</th>
	</thead>
	<tbody>
		@foreach ($room_actions as $room_action)
		<tr>
			<td>{{$room_action->id}}</td>
			<td><a href="/room_action/edit/{{$room_action->id}}">{{$room_action->uid}}</a></td>
		</tr>
		@endforeach
	</tbody>
</table>

<script>
$('#all-room_actions').dataTable();
</script>
@endif

@endsection