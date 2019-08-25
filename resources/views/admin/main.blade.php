@extends('layouts.admin')

@section('content')
	Admin Links:

	<div style="margin-left: 2rem;">

		<h3>Building Tools</h3>
		<a href="zone/all">All Zones</a><br>
		<a href="room/all">All Rooms</a><br>
		<a href="item/all">All Items</a><br>
		<a href="npc/all">All NPCs</a><br>
		<a href="forge/all">All Forge Recipes</a><br>
		<h3>Admin Tools</h3>
		<a href="user/all">All Users</a><br>
		<a href="character/all">All Characters</a><br>
		<a href="shop/all">All Shops</a><br>
		<h3>Moderation Tools</h3>
		<form method="post" action="admin/give_item">
			<label for="give-submit">Give Character Item</label>
			<input type="submit" id="give-submit" style="display:none;">
			{{ csrf_field() }}
		</form>
	</div>

<br><br>
@endsection