@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div class="dt-container">
	<div>
		<form method="get" action="/teleport/create">
			<div class="form-group row">
				<div class="col-md-2">
					<input type="submit" value="Add TeleportTarget" class="form-control btn btn-success">
				</div>
			</div>
		</form>
	</div>
	@if ($teleports)
	<table id="all-teleports">
		<thead>
			<th>ID</th>
			<th>Name</th>
			<th>Spell</th>
			<th>Room ID</th>
			<th>Level Req</th>
			<th>Wisdom Req</th>
		</thead>
		<tbody>
			@foreach ($teleports as $teleport)
			<tr>
				<td>{{$teleport->id}}</td>
				<td><a href="/teleport/edit/{{$teleport->id}}">{{$teleport->name}}</a></td>
				<td><a href="/spell/edit/{{$teleport->spells_id}}">{{$teleport->spell()->name}}</a></td>
				<td>{{$teleport->rooms_id}}</td>
				<td>{{$teleport->level_req}}</td>
				<td>{{$teleport->wisdom_req}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<script>
	$('#all-teleports').dataTable();
	</script>
	@endif
</div>



@endsection 