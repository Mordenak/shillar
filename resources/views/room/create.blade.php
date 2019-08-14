@extends('layouts.admin')

@section('content')
Creating a new room:<br>

<div>
	<form action="/room/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Zone:</label>
			<div class="col-md-3">
				<select name="selected_zone" class="form-control">
					@foreach ($zones as $zone)
					<option value="{{$zone->id}}">({{$zone->id}}) {{$zone->name}}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Title:</label>
			<div class="col-md-3">
				<input type="text" name="title" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Description:</label>
			<div class="col-md-3">
				<input type="text" name="description" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">North Room:</label>
			<div class="col-md-3">
				<input type="text" name="north_room_id" class="form-control">
			</div>
			<div class="offset-md">
				<input type="checkbox" name="north_room_link"> Link?
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">East Room:</label>
			<div class="col-md-3">
				<input type="text" name="east_room_id" class="form-control">
			</div>
			<div class="offset-md">
				<input type="checkbox" name="east_room_link"> Link?
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">South Room:</label>
			<div class="col-md-3">
				<input type="text" name="south_room_id" class="form-control">
			</div>
			<div class="offset-md">
				<input type="checkbox" name="south_room_link"> Link?
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">West Room:</label>
			<div class="col-md-3">
				<input type="text" name="west_room_id" class="form-control">
			</div>
			<div class="offset-md">
				<input type="checkbox" name="west_room_link"> Link?
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Up Room:</label>
			<div class="col-md-3">
				<input type="text" name="up_room_id" class="form-control">
			</div>
			<div class="offset-md">
				<input type="checkbox" name="up_room_link"> Link?
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Down Room:</label>
			<div class="col-md-3">
				<input type="text" name="down_room_id" class="form-control">
			</div>
			<div class="offset-md">
				<input type="checkbox" name="down_room_link"> Link?
			</div>
		</div>

		<div class="form-group row mb-0">
			<div class="col-md-1 offset-md-1">
				<a href="/room/all" class="btn btn-primary">Cancel</a>
			</div>
			<div class="col-md-2 offset-md-2">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>
@endsection