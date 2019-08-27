@extends('layouts.admin')

@section('content')
	Admin Links:

	<div style="margin-left: 2rem;">

		<h3>Building Tools (Admin Level 1)</h3>
		<a href="zone/all">All Zones</a><br>
		<a href="room/all">All Rooms</a><br>
		<a href="item/all">All Items</a><br>
		<a href="npc/all">All NPCs</a><br>
		<a href="shop/all">All Shops</a><br>
		<a href="quest/all">All Quests</a><br>
		<a href="room_action/all">All RoomActions</a><br>
		<a href="forge/all">All Forge Recipes</a><br>
		<h3>Moderation Tools (Admin Level 2)</h3>
		<form method="post" action="admin/give_item">
			<label for="give-submit">Give Character Item</label>
			<input type="submit" id="give-submit" style="display:none;">
			{{ csrf_field() }}
		</form>
		<h3>Admin Tools (Admin Level 3)</h3>
		<a href="user/all">All Users</a><br>
		<a href="character/all">All Characters</a><br>
		<a href="admin/zone-editor">Zone Editor</a><br>
	</div>

<br><br>
@endsection