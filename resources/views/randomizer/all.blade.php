@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div>
	<form method="get" action="/randomizer/create">
		<div class="form-group row">
			<div class="col-md-3">
				<input type="submit" value="Add Chat Room" class="btn btn-success">
			</div>
		</div>
	</form>
</div>

@if ($randomizers)
<table id="all-records">
	<thead>
		<th>ID</th>
		<th>Name</th>
	</thead>
	<tbody>
		@foreach ($randomizers as $randomizer)
		<tr>
			<td>{{$randomizer->id}}</td>
			<td><a href="/randomizer/edit/{{$randomizer->id}}">{{$randomizer->uid}}</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
@endif

@endsection 