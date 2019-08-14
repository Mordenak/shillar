@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div>
	<form method="get" action="/zone/create">
		<div class="form-group row">
			<div class="col-md-3">
				<input type="submit" value="Add Zone" class="form-control">
			</div>
		</div>
	</form>
</div>

@if ($zones)
<table id="all-zones">
	<thead>
		<th>ID</th>
		<th>Zone Name</th>
	</thead>
	<tbody>
		@foreach ($zones as $zone)
		<tr>
			<td>{{$zone->id}}</td>
			<td><a href="/zone/edit/{{$zone->id}}">{{$zone->name}}</a></td>
		</tr>
		@endforeach
	</tbody>
</table>

<script>
$('#all-zones').dataTable();
</script>
@endif

@endsection 