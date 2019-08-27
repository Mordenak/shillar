@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div>
	<form method="get" action="/quest/create">
		<div class="form-group row">
			<div class="col-md-3">
				<input type="submit" value="Add Quest" class="btn btn-success">
			</div>
		</div>
	</form>
</div>

@if ($quests)
<table id="all-quests">
	<thead>
		<th>ID</th>
		<th>Recipe Name</th>
	</thead>
	<tbody>
		@foreach ($quests as $quest)
		<tr>
			<td>{{$quest->id}}</td>
			<td><a href="/quest/edit/{{$quest->id}}">{{$quest->name}}</a></td>
		</tr>
		@endforeach
	</tbody>
</table>

<script>
$('#all-quests').dataTable();
</script>
@endif

@endsection