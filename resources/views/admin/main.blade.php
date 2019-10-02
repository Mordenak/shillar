@extends('layouts.admin')

@section('content')
	<div style="margin-left: 2rem;">

		* [NYI] = Not Yet Implemented
		<h3>Building Tools (Admin Level 1)</h3>
		<a href="admin/zone-editor">Zone Editor [WIP]</a><br>
		<br>
		<a href="zone/all">All Zones</a><br>
		<a href="zone_area/all">All Zone Areas</a><br>
		<a href="room/all">All Rooms</a><br>
		<a href="item/all">All Items</a><br>
		<a href="creature/all">All Creatures</a><br>
		<a href="creature_group/all">All Creature Groups</a><br>
		<a href="shop/all">All Shops</a><br>
		<a href="quest/all">All Quests</a><br>
		<a href="race/all">All Races [NYI]</a><br>
		<a href="forge/all">All Forges [NYI]</a><br>
		<a href="forge/all">All Forge Recipes</a><br>
		<a href="spell/all">All Spells [NYI]</a><br>
		<a href="teleport/all">Teleport Targets [NYI]</a><br>
		<a href="room_action/all">All RoomActions</a><br>
		<a href="admin/knowledge">Knowledge Base [NYI]</a><br>
		@if (auth()->user()->admin_level > 1)
		<h3>Moderation & Testing Tools (Admin Level 2)</h3>
		<form method="post" action="admin/give_item" style="display:inline-block;margin:0;">
			<label for="give-submit" class="link-label">Give Character Item</label>
			<input type="submit" id="give-submit" style="display:none;">
			{{ csrf_field() }}
		</form><br>
		<form method="post" action="admin/give_item" style="display:inline-block;margin:0;">
			<label for="give-submit" class="link-label">Give Character Quest [NYI]</label>
			<input type="submit" id="give-submit" style="display:none;">
			{{ csrf_field() }}
		</form><br>
		<a href="character/all">All Characters</a><br>
		<h3>Admin Tools (Admin Level 3)</h3>
		@endif
		@if (auth()->user()->admin_level > 2)
		<a href="user/all">All Users</a><br>
		@endif
	</div>

	<br><br>
	<p style="margin-left: 2rem;">
		<a href="/home" class="btn btn-warning">Back to Game</a>
	</p>

<br><br>
@endsection