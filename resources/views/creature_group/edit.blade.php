@extends('layouts.admin')

@section('content')
<div>
	<form action="/creature_group/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($creature_group) ? $creature_group->name : ''}}" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Description:</label>
			<div class="col-md-3">
				<input type="text" name="description" value="{{isset($creature_group) ? $creature_group->description : ''}}" class="form-control">
			</div>
		</div>

		<h3>Creatures</h3>

		<div class="creature-tables">
			<div class="creature-forms">
			@if (isset($creature_group) && $creature_group->linked_creatures()->count() > 0)
				@foreach ($creature_group->linked_creatures()->get() as $linked_creature)
				<input type="hidden" name="creature_tables[{{$linked_creature->id}}][id]" value="{{$linked_creature->id}}">
				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">Creature:</label>
					<div class="col-md-2">
						<input type="text" name="creature_tables[{{$linked_creature->id}}][creatures_id]" value="{{$linked_creature->creatures_id}}" class="form-control auto-lookup creature-lookup">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Weight:</label>
					<div class="col-md-1">
						<input type="text" name="creature_tables[{{$linked_creature->id}}][weight]" value="{{$linked_creature->weight}}" class="form-control">
					</div>
				</div>
				@endforeach
			@endif
				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">Creature:</label>
					<div class="col-md-2">
						<input type="text" name="creature_tables[0][creatures_id]" class="form-control auto-lookup creature-lookup">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Weight:</label>
					<div class="col-md-1">
						<input type="text" name="creature_tables[0][weight]" class="form-control">
					</div>
				</div>
			</div>
		</div>

		<br>
		<a class="fa fa-plus" onclick="addCreature(this);">Add Creature</a>
		<br><br>

		<h3>Spawn Rules:</h3>
		<div class="spawn-rules">
			<div class="spawn-forms">
			@if (isset($creature_group) && $creature_group->spawn_rules()->count() > 0)
				@foreach ($creature_group->spawn_rules()->get() as $spawn_rule)
				<input type="hidden" name="spawns[{{$spawn_rule->id}}][id]" value="{{$spawn_rule->id}}">
				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">Zone:</label>
					<div class="col-md-2">
						<input type="text" name="spawns[{{$spawn_rule->id}}][zones_id]" value="{{$spawn_rule->zones_id}}" class="form-control auto-lookup zone-lookup">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Zone Area:</label>
					<div class="col-md-2">
						<input type="text" name="spawns[{{$spawn_rule->id}}][zone_areas_id]" value="{{$spawn_rule->zone_areas_id}}" class="form-control auto-lookup zone-area-lookup">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Zone Level:</label>
					<div class="col-md-1">
						<input type="text" name="spawns[{{$spawn_rule->id}}][zone_level]" value="{{$spawn_rule->zone_level}}" class="form-control">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Room:</label>
					<div class="col-md-1">
						@if ($spawn_rule->room())
						<input type="text" name="spawns[{{$spawn_rule->id}}][room_id]" value="{{$spawn_rule->room()->id}}" class="form-control auto-lookup room-lookup">
						@else
						<input type="text" name="spawns[{{$spawn_rule->id}}][rooms_id]" class="form-control auto-lookup room-lookup">
						@endif
					</div>
					<label class="col-md-1 col-form-label text-md-right">Spawn Hour:</label>
					<div class="col-md-1">
						<input type="text" name="spawns[0][spawn_hour]" class="form-control">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Random Hour?</label>
					<div class="col-md-1">
						<input type="checkbox" name="spawns[0][random_hour]" class="form-control">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Priority:</label>
					<div class="col-md-1">
						<input type="text" name="spawns[0][spawn_hour]" class="form-control">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Score Req:</label>
					<div class="col-md-1">
						<input type="text" name="spawns[0][spawn_hour]" class="form-control">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Spawns Once?</label>
					<div class="col-md-1">
						<input type="checkbox" name="spawns[0][spawn_hour]" class="form-control">
					</div>
				</div>
				@endforeach
			@endif
				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">Zone:</label>
					<div class="col-md-2">
						<input type="text" name="spawns[0][zones_id]" class="form-control auto-lookup zone-lookup">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Zone Area:</label>
					<div class="col-md-2">
						<input type="text" name="spawns[0][zone_areas_id]" class="form-control auto-lookup zone-area-lookup">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Zone Level:</label>
					<div class="col-md-1">
						<input type="text" name="spawns[0][zone_level]" class="form-control">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Room:</label>
					<div class="col-md-1">
						<input type="text" name="spawns[0][rooms_id]" class="form-control auto-lookup room-lookup">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Spawn Hour:</label>
					<div class="col-md-1">
						<input type="text" name="spawns[0][spawn_hour]" class="form-control">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Random Hour?</label>
					<div class="col-md-1">
						<input type="checkbox" name="spawns[0][random_hour]" class="form-control">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Priority:</label>
					<div class="col-md-1">
						<input type="text" name="spawns[0][spawn_hour]" class="form-control">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Score Req:</label>
					<div class="col-md-1">
						<input type="text" name="spawns[0][spawn_hour]" class="form-control">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Spawns Once?</label>
					<div class="col-md-1">
						<input type="checkbox" name="spawns[0][spawn_hour]" class="form-control">
					</div>
				</div>
			
			</div>
		</div>


		<br>
		<a class="fa fa-plus" onclick="addSpawnRule(this);">Add Spawn Rule</a>

		<br><br>

		@if (isset($creature_group))
		<input type="hidden" name="id" value="{{$creature_group->id}}">
		@endif
	</form>
	<!-- TODO: See zone/edit.blade.php for comments on this component placement -->
	<x-admin-nav title="{{ isset($creature_group) ? 'Editing a Creature Group' : 'Creating a Creature Group' }}" baseroute="creature_group" dbid="{{ isset($creature_group) ? $creature_group->id : 0}}"></x-admin-nav>
</div>

<br><br>
@if (isset($creature))
<div class="col-md-1">
	<form method="post" action="/creature/delete">
		{{csrf_field()}}
		<input type="hidden" name="id" value="{{$creature->id}}">
		<input type="submit" value="Delete This Creature" class="btn btn-danger">
	</form>
</div>
@endif

<style>
.spawn-forms > div
	{
/*	border: 1px solid #ccc;
	padding: .5rem;*/
	}
</style>

<script>
function addSpawnRule($btn)
	{
	var $tmp = $('.spawn-forms > div').last().clone();
	// console.log($tmp.find('input').first().attr('name'));
	var matches = $tmp.find('input').first().attr('name').match(/spawns\[(\d*)\]/);
	
	var new_id = parseInt(matches[1]) + 1;

	$tmp.find('.form-control').each(function(i) {
		var name = $(this).attr('name').replace(/spawns\[\d*\]/, 'spawns['+new_id+']');
		$(this).attr('name', name);
		});

	$('.spawn-forms').append($tmp);
	$('.spawn-forms').last().find('input[name="id"]').remove();
	}

function addCreature($btn)
	{
	var $tmp = $('.creature-forms > div').last().clone();
	// console.log($tmp.find('input').first().attr('name'));
	var matches = $tmp.find('input').first().attr('name').match(/creature_tables\[(\d*)\]/);
	
	var new_id = parseInt(matches[1]) + 1;

	$tmp.find('.form-control').each(function(i) {
		var name = $(this).attr('name').replace(/creature_tables\[\d*\]/, 'creature_tables['+new_id+']');
		$(this).attr('name', name);
		});

	$('.creature-forms').append($tmp);
	$('.creature-forms').last().find('input[name="id"]').remove();
	}
</script>

@endsection
