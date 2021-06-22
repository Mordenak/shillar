@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div>
	<form method="get" action="/race/create">
		<div class="form-group row">
			<div class="col-md-3">
				<input type="submit" value="Add Race" class="btn btn-success">
			</div>
		</div>
	</form>
</div>

@if ($races)
<table id="all-records">
	<thead>
		<th>ID</th>
		<th>Race Name</th>
		<th>Gender</th>
		<th>Stats</th>
	</thead>
	<tbody>
		@foreach ($races as $race)
		<tr>
			<td>{{$race->id}}</td>
			<td><a href="/race/edit/{{$race->id}}">{{$race->name}}</a></td>
			<td>{{$race->gender}}</td>
			@if ($race->starting_stats()->first())
			<td>{{$race->starting_stats()->first()->strength}}</td>
			@endif
		</tr>
		@endforeach
	</tbody>
</table>
@endif

@endsection 