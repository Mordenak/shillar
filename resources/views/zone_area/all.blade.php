@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div class="dt-container">
	<div>
		<form method="get" action="/zone_area/create">
			<div class="form-group row">
				<div class="col-md-2">
					<input type="submit" value="Add ZoneArea" class="form-control btn btn-success">
				</div>
			</div>
		</form>
	</div>
	@if ($zone_areas)
	<table id="all-zone_areas">
		<thead>
			<th>ID</th>
			<th>Zone Name</th>
		</thead>
		<tbody>
			@foreach ($zone_areas as $zone_area)
			<tr>
				<td>{{$zone_area->id}}</td>
				<td><a href="/zone_area/edit/{{$zone_area->id}}">{{$zone_area->name}}</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<script>
	$('#all-zone_areas').dataTable();
	</script>
	@endif
</div>



@endsection 