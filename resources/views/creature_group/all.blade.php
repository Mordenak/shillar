@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div class="dt-container">
	<div>
		<form method="get" action="/creature_group/create">
			<div class="form-group row">
				<div class="col-md-3">
					<input type="submit" value="Add Creature Group" class="form-control btn btn-success">
				</div>
			</div>
		</form>
	</div>

	@if ($creature_groups)
	<table id="all-creature_groups">
		<thead>
			<th>ID</th>
			<th>Name</th>
		</thead>
		<tbody>
			@foreach ($creature_groups as $creature_group)
			<tr>
				<td>{{$creature_group->id}}</td>
				<td>
					<a href="/creature_group/edit/{{$creature_group->id}}">{{$creature_group->name}}</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<script>
$('#all-creature_groups').dataTable();
</script>
@endif

@endsection