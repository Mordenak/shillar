@extends('layouts.admin')

@section('content')
@if (isset($room))
Editing a room:<br>
@else
Creating a new room:<br>
@endif

<div>
	<form action="/room/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Zone:</label>
			<div class="col-md-3">
				<select name="selected_zone" class="form-control">
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
			<label class="col-md-2 col-form-label text-md-right">Zone Area:</label>
			<div class="col-md-3">
				<input type="text" name="zone_areas_id" value="{{isset($room) ? $room->zone_areas_id : ''}}" class="form-control auto-lookup zone-area-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Level:</label>
			<div class="col-md-3">
				<input type="text" name="zone_level" value="{{isset($room) ? $room->zone_level : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">UID:</label>
			<div class="col-md-3">
				<input type="text" name="uid" value="{{isset($room) ? $room->uid : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Title:</label>
			<div class="col-md-3">
				<input type="text" name="title" value="{{isset($room) ? $room->title : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Description:</label>
			<div class="col-md-3">
				<input type="text" name="description" value="{{isset($room) ? $room->description : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Img Src:</label>
			<div class="col-md-3">
				<input type="text" name="img_src" value="{{isset($room) ? $room->img_src : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Special Property:</label>
			<div class="col-md-3">
				<input type="text" name="room_properties_id" value="{{isset($room) ? $room->room_properties_id : ''}}" class="form-control room-property-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Spawns Enabled:</label>
			<div class="col-md-1">
				<input type="checkbox" name="spawns_enabled" class="form-control" {{isset($room) && $room->spawns_enabled ? 'checked' : ''}}>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">North Room:</label>
			<div class="col-md-1">
				<input type="text" name="north_room_id" value="{{isset($room) ? $room->north_rooms_id : ''}}" class="form-control room-lookup">
			</div>
			<div class="offset-md-0">
				<input type="checkbox" name="north_room_link"> Link?
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">East Room:</label>
			<div class="col-md-1">
				<input type="text" name="east_room_id" value="{{isset($room) ? $room->east_rooms_id : ''}}" class="form-control room-lookup">
			</div>
			<div class="offset-md-0">
				<input type="checkbox" name="east_room_link"> Link?
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">South Room:</label>
			<div class="col-md-1">
				<input type="text" name="south_room_id" value="{{isset($room) ? $room->south_rooms_id : ''}}" class="form-control room-lookup">
			</div>
			<div class="offset-md-0">
				<input type="checkbox" name="south_room_link"> Link?
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">West Room:</label>
			<div class="col-md-1">
				<input type="text" name="west_room_id" value="{{isset($room) ? $room->west_rooms_id : ''}}" class="form-control room-lookup">
			</div>
			<div class="offset-md-0">
				<input type="checkbox" name="west_room_link"> Link?
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Up Room:</label>
			<div class="col-md-1">
				<input type="text" name="up_room_id" value="{{isset($room) ? $room->up_rooms_id : ''}}" class="form-control room-lookup">
			</div>
			<div class="offset-md-0">
				<input type="checkbox" name="up_room_link"> Link?
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Down Room:</label>
			<div class="col-md-1">
				<input type="text" name="down_room_id" value="{{isset($room) ? $room->down_rooms_id : ''}}" class="form-control room-lookup">
			</div>
			<div class="offset-md-0">
				<input type="checkbox" name="down_room_link"> Link?
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Northeast Room:</label>
			<div class="col-md-1">
				<input type="text" name="northeast_rooms_id" value="{{isset($room) ? $room->northeast_rooms_id : ''}}" class="form-control room-lookup">
			</div>
			<div class="offset-md-0">
				<input type="checkbox" name="northeast_room_link"> Link?
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Southeast Room:</label>
			<div class="col-md-1">
				<input type="text" name="southeast_rooms_id" value="{{isset($room) ? $room->southeast_rooms_id : ''}}" class="form-control room-lookup">
			</div>
			<div class="offset-md-0">
				<input type="checkbox" id="southeast_room_link" name="southeast_room_link">
				<label for="southeast_room_link">Link?</label>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Southwest Room:</label>
			<div class="col-md-1">
				<input type="text" name="southwest_rooms_id" value="{{isset($room) ? $room->southwest_rooms_id : ''}}" class="form-control room-lookup">
			</div>
			<div class="offset-md-0">
				<input type="checkbox" id="southwest_room_link" name="southwest_room_link">
				<label for="southwest_room_link">Link?</label>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Northwest Room:</label>
			<div class="col-md-1">
				<input type="text" name="northwest_rooms_id" value="{{isset($room) ? $room->northwest_rooms_id : ''}}" class="form-control room-lookup">
			</div>
			<div class="offset-md-0">
				<input type="checkbox" id="northwest_room_link" name="northwest_room_link"> 
				<label for="northwest_room_link">Link?</label>
			</div>
		</div>

		@if (isset($room))
		<input type="hidden" name="id" id="db-id" value="{{$room->id}}">
		@endif

		<div class="form-group row fixed-top" style="padding:.5rem;background-color:#555;border-bottom:2px solid white;">
			<div class="col-md-1">
				<a href="/admin" class="btn btn-info">Admin Home</a>
			</div>
			<div class="col-md-3 offset-md-1">
				<h3>
				@if (isset($zone))
				Editing a Room:
				@else
				Creating a Room:
				@endif
				</h3>
			</div>
			<div class="col-md-1">
				<a href="/room/all" class="btn btn-secondary">Cancel</a>
			</div>
			<div class="col-md-1">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>

<br><br>
@if (isset($room))
<div class="col-md-1">
	<form method="post" action="/room/delete">
		{{csrf_field()}}
		<input type="hidden" name="id" value="{{$room->id}}">
		<input type="submit" value="Delete This Room" class="btn btn-danger">
	</form>
</div>
@endif
@endsection