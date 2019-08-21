@extends('layouts.admin')

@section('content')
	Admin Links:

	<div style="margin-left: 2rem;">

		<h3>Building Tools</h3>
		<a href="zone/all">All Zones</a><br>
		<a href="room/all">All Rooms</a><br>
		<a href="item/all">All Items</a><br>
		<a href="npc/all">All NPCs</a><br>
		<h3>Admin Tools</h3>
		<a href="user/all">All Users</a><br>
		<a href="character/all">All Characters</a><br>
		<a href="shop/all">All Shops</a><br>
	</div>

<br><br>
@endsection