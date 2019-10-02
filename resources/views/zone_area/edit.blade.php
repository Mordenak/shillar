@extends('layouts.admin')

@section('content')

<div>
	<form action="/zone_area/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Zone:</label>
			<div class="col-md-3">
				<select name="zones_id" class="form-control">
					@if (!isset($room))
					<option disabled selected>-- Select --</option>
					@endif
					@foreach ($zones as $zone)
					@if (isset($room))
					<option value="{{$zone->id}}" {{$zone->id == $room->zone()->id ? 'selected' : ''}}>({{$zone->id}}) {{$zone->name}}</option>
					@else
					<option value="{{$zone->id}}">({{$zone->id}}) {{$zone->name}}</option>
					@endif
					@endforeach
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($zone_area) ? $zone_area->name : ''}}" class="form-control" required>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Travel Text:</label>
			<div class="col-md-3">
				<input type="text" name="travel_text" value="{{isset($zone_area) ? $zone_area->travel_text : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Image:</label>
			<div class="col-md-3">
				<input type="text" name="bg_img" value="{{isset($zone_area) ? $zone_area->bg_img : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Background Color [NYI]:</label>
			<div class="col-md-3">
				<input type="text" name="bg_color" value="{{isset($zone_area) ? $zone_area->bg_color : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Text Color [NYI]:</label>
			<div class="col-md-3">
				<input type="text" name="font_color" value="{{isset($zone_area) ? $zone_area->font_color : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Link Color [NYI]:</label>
			<div class="col-md-3">
				<input type="text" name="label_color" value="{{isset($zone_area) ? $zone_area->label_color : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Description:</label>
			<div class="col-md-6">
				<textarea class="form-control" name="description">{{isset($zone_area) ? $zone_area->description : ''}}</textarea>
			</div>
		</div>

		@if (isset($zone_area))
		<input type="hidden" name="id" id="db-id" value="{{$zone_area->id}}">
		@endif

		<div class="form-group row fixed-top" style="padding:.5rem;background-color:#555;border-bottom:2px solid white;">
			<div class="col-md-1">
				<a href="/admin" class="btn btn-info">Admin Home</a>
			</div>
			<div class="col-md-3 offset-md-1">
				<h3>
				@if (isset($zone_area))
				Editing a ZoneArea:
				@else
				Creating a ZoneArea:
				@endif
				</h3>
			</div>
			<div class="col-md-1">
				<a href="/zone_area/all" class="btn btn-secondary">Cancel</a>
			</div>
			<div class="col-md-1">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>

<br><br>
@if (isset($zone_area))
<div class="col-md-1">
	<form method="post" action="/zone_area/delete">
		{{csrf_field()}}
		<input type="hidden" name="id" value="{{$zone_area->id}}">
		<input type="submit" value="Delete This ZoneArea" class="btn btn-danger">
	</form>
</div>
@endif

@endsection