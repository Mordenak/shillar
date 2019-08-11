@extends('layouts.admin')

@section('content')
	Admin Links:

	<div style="margin-left: 2rem;">
		<form method="post" action="/admin/process">
			<br><br>
			Create a:
			<select name="create">
				<option>--Select--</option>
				<option value="zone">Zone</option>
				<option value="room">Room</option>
				<option value="item">Item</option>
				<option value="npc">NPC</option>
			</select>
			<input type="submit" value="Go!">
			<br><br>

			Edit a:
			<select name="edit">
				<option>--Select--</option>
				<option value="room">Room</option>
			</select>
			<input type="submit" value="Go!">
			<br><br>

			Delete a:
			<select name="delete">
				<option>--Select--</option>
				<option value="room">Room</option>
			</select>
			<input type="submit" value="Go!">
			{{csrf_field()}}
		</form>

		<a href="zone/all">All Zones</a><br>
		<a href="room/all">All Rooms</a><br>
		<a href="item/all">All Items</a><br>
		<a href="npc/all">All NPCs</a><br>
	</div>

<br><br>
<a href="/home">Go back</a>
@endsection