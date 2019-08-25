@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div>
	<form method="get" action="/forge/create">
		<div class="form-group row">
			<div class="col-md-3">
				<input type="submit" value="Add Forge Recipe" class="btn btn-success">
			</div>
		</div>
	</form>
</div>

@if ($forges)
<table id="all-forges">
	<thead>
		<th>ID</th>
		<th>Recipe Name</th>
		<th>Resulting Item</th>
	</thead>
	<tbody>
		@foreach ($forges as $forge)
		<tr>
			<td>{{$forge->id}}</td>
			<td><a href="/forge/edit/{{$forge->id}}">{{$forge->name}}</a></td>
			<td>{{$forge->result_item()->name}}</td>
		</tr>
		@endforeach
	</tbody>
</table>

<script>
$('#all-forges').dataTable();
</script>
@endif

@endsection