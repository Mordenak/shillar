@extends('layouts.admin')

@section('content')
	Admin Links:

	<div style="margin-left: 2rem;">
		<a href="zone/all">All Zones</a><br>
		<a href="room/all">All Rooms</a><br>
		<a href="item/all">All Items</a><br>
		<a href="npc/all">All NPCs</a><br>
	</div>

<br><br>
<a href="/home">Go back</a>
@endsection