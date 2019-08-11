@extends('layouts.admin')

@section('content')
Editing a room:<br>


<form action="/room/save" method="POST" class="form-horizontal">
	{{ csrf_field() }}
	
	Zone:
	<select name="selected_zone">
		@foreach ($zones as $zone)
			<option value="{{$zone->id}}">({{$zone->id}}) {{$zone->name}}</option>
		@endforeach
	</select>
	<br>
	Title: <input type="text" name="title" value="{{$room->title}}"><br>
	Description: <input type="text" name="description" value="{{$room->description}}"><br>
	North Room: <input type="text" name="north_room_id" value="{{$room->north_rooms_id}}"><br>
	East Room: <input type="text" name="east_room_id" value="{{$room->east_rooms_id}}"><br>
	South Room: <input type="text" name="south_room_id" value="{{$room->south_rooms_id}}"><br>
	West Room: <input type="text" name="west_room_id" value="{{$room->west_rooms_id}}"><br>
	<input type="hidden" name="id" value="{{$room->id}}">
	<input type="submit" value="Save!">
</form>
@endsection