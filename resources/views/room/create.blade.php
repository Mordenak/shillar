@extends('layouts.admin')

@section('content')
Creating a new room:<br>


<form action="/room/save" method="POST" class="form-horizontal">
	{{ csrf_field() }}
	
	Zone:
	<select name="selected_zone">
		@foreach ($zones as $zone)
			<option value="{{$zone->id}}">({{$zone->id}}) {{$zone->name}}</option>
		@endforeach
	</select>
	<br>
	Title: <input type="text" name="title"><br>
	Description: <input type="text" name="description"><br>
	North Room: <input type="text" name="north_room_id"><br>
	East Room: <input type="text" name="east_room_id"><br>
	South Room: <input type="text" name="south_room_id"><br>
	West Room: <input type="text" name="west_room_id"><br>
	<input type="submit" value="Create!">
</form>
@endsection