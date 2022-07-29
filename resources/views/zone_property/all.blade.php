@extends('layouts.admin')

@section('content')

<br>
<a href="/admin">Go back</a>
<br><br>

<div class="dt-container">
	<div>
		<form method="get" action="/zone_property/create">
			<div class="form-group row">
				<div class="col-md-2">
					<input type="submit" value="Add Zone Property" class="form-control btn btn-success">
				</div>
			</div>
		</form>
	</div>
	@if ($zone_properties)
	<table id="all-records">
		<thead>
			<th>ID</th>
			<th>Property Name</th>
		</thead>
		<tbody>
			@foreach ($zone_properties as $zone_property)
			<tr>
				<td>{{$zone_property->id}}</td>
				<td><a href="/zone_property/edit/{{$zone_property->id}}">{{$zone_property->name}}</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>	
	@endif
</div>
@endsection 