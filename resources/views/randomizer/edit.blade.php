@extends('layouts.admin')

@section('content')

<div>
	<form action="/randomizer/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">UID:</label>
			<div class="col-md-3">
				<input type="text" name="uid" value="{{isset($randomizer) ? $randomizer->uid : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Room:</label>
			<div class="col-md-3">
				<input type="text" name="rooms_id" value="{{isset($randomizer) ? $randomizer->rooms_id : ''}}" class="form-control auto-lookup room-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Zone:</label>
			<div class="col-md-3">
				<input type="text" name="zones_id" value="{{isset($randomizer) ? $randomizer->zones_id : ''}}" class="form-control auto-lookup zone-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Zone Area:</label>
			<div class="col-md-3">
				<input type="text" name="zone_areas_id" value="{{isset($randomizer) ? $randomizer->zone_areas_id : ''}}" class="form-control auto-lookup zon-area-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Creature:</label>
			<div class="col-md-3">
				<input type="text" name="creatures_id" value="{{isset($randomizer) ? $randomizer->creatures_id : ''}}" class="form-control auto-lookup creature-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Creature Group:</label>
			<div class="col-md-3">
				<input type="text" name="creature_groups_id" value="{{isset($randomizer) ? $randomizer->creature_groups_id : ''}}" class="form-control auto-lookup creature-group-lookup">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Rotation Hours:</label>
			<div class="col-md-3">
				<input type="text" name="rotation_hours" value="{{isset($randomizer) ? $randomizer->rotation_hours : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Spawn Chance:</label>
			<div class="col-md-3">
				<input type="text" name="spawn_chance" value="{{isset($randomizer) ? $randomizer->spawn_chance : ''}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Block Other Spawns?:</label>
			<div class="col-md-3">
				<input type="checkbox" name="block_other_spawns" class="form-control" {{isset($randomizer) && $randomizer->block_other_spawns ? 'checked' : ''}}>
			</div>
		</div>


		@if (isset($randomizer))
		<input type="hidden" name="id" id="db-id" value="{{$randomizer->id}}">
		@endif
	</form>
</div>

<!-- TODO: See zone/edit.blade.php for comments on this component placement -->
<x-admin-nav title="{{ isset($randomizer) ? 'Editing a Randomizer' : 'Creating a Randomizer' }}" baseroute="randomizer" dbid="{{ isset($randomizer) ? $randomizer->id : 0}}"></x-admin-nav>
@endsection