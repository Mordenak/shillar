@extends('layouts.admin')

@section('content')

<div>
	<form action="/zone_property/save" method="POST" class="form-horizontal main-form">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($zone_property) ? $zone_property->name : ''}}" class="form-control" required>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Description:</label>
			<div class="col-md-3">
				<input type="text" name="description" value="{{isset($zone_property) ? $zone_property->description : ''}}" class="form-control" required>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Format:</label>
			<div class="col-md-3">
				<input type="text" name="format" value="{{isset($zone_property) ? $zone_property->format : ''}}" class="form-control" required>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Custom View:</label>
			<div class="col-md-3">
				<input type="text" name="custom_view" value="{{isset($zone_property) ? $zone_property->custom_view : ''}}" class="form-control" required>
			</div>
		</div>

		@if (isset($zone_property))
		<input type="hidden" name="id" id="db-id" value="{{$zone_property->id}}">
		@endif

	</form>
</div>

<!-- This is where this should live: -->
<x-admin-nav title="{{ isset($zone_property) ? 'Editing a Zone Property' : 'Creating a Zone Property' }}" baseroute="zone_property" dbid="{{ isset($zone_property) ? $zone_property->id : 0}}"></x-admin-nav>

@endsection