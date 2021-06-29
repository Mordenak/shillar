@extends('layouts.admin')

@section('content')
<div>
	<form action="/creature/save" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{isset($creature) ? $creature->name : ''}}" class="form-control">
			</div>
			<label class="col-md-2 col-form-label text-md-right">Img Src:</label>
			<div class="col-md-3">
				<input type="text" name="img_src" value="{{isset($creature) ? $creature->img_src : ''}}" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Health:</label>
			<div class="col-md-3">
				<input type="text" name="health" value="{{isset($creature) ? $creature->health : ''}}" class="form-control">
			</div>
			<label class="col-md-2 col-form-label text-md-right">Attack Text:</label>
			<div class="col-md-3">
				<input type="text" name="attack_text" value="{{isset($creature) ? $creature->attack_text : ''}}" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Armor:</label>
			<div class="col-md-3">
				<input type="text" name="armor" value="{{isset($creature) ? $creature->armor : ''}}" class="form-control">
			</div>

			<label class="col-md-2 col-form-label text-md-right">Award XP:</label>
			<div class="col-md-3">
				<input type="text" name="award_xp" value="{{isset($creature) ? $creature->award_xp : ''}}" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Damage Min:</label>
			<div class="col-md-3">
				<input type="text" name="damage_low" value="{{isset($creature) ? $creature->damage_low : ''}}" class="form-control">
			</div>
			<label class="col-md-2 col-form-label text-md-right">XP Variation:</label>
			<div class="col-md-3">
				<input type="text" name="xp_variation" value="{{isset($creature) ? $creature->xp_variation : '0.1'}}" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Damage Max:</label>
			<div class="col-md-3">
				<input type="text" name="damage_high" value="{{isset($creature) ? $creature->damage_high : ''}}" class="form-control">
			</div>
			<label class="col-md-2 col-form-label text-md-right">Award Gold:</label>
			<div class="col-md-3">
				<input type="text" name="award_gold" value="{{isset($creature) ? $creature->award_gold : ''}}" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Attacks:</label>
			<div class="col-md-3">
				<input type="text" name="attacks_per_round" value="{{isset($creature) ? $creature->attacks_per_round : ''}}" class="form-control">
			</div>
			<label class="col-md-2 col-form-label text-md-right">Gold Variation:</label>
			<div class="col-md-3">
				<input type="text" name="gold_variation" value="{{isset($creature) ? $creature->gold_variation : '0.375'}}" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Magic Resist:</label>
			<div class="col-md-3">
				<input type="text" name="magic_resistance" value="{{isset($creature) ? $creature->magic_resistance : ''}}" class="form-control">
			</div>
			<label class="col-md-2 col-form-label text-md-right">Scroll Resist:</label>
			<div class="col-md-3">
				<input type="text" name="scroll_resistance" value="{{isset($creature) ? $creature->scroll_resistance : ''}}" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Alignment:</label>
			<div class="col-md-3">
				<input type="text" name="alignments_id" value="{{isset($creature) ? $creature->alignments_id : ''}}" class="form-control">
			</div>
			<label class="col-md-2 col-form-label text-md-right">Alignment Strength:</label>
			<div class="col-md-3">
				<input type="text" name="alignment_strength" value="{{isset($creature) ? $creature->alignment_strength : ''}}" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Hostile:</label>
			<div class="col-md-3">
				<input type="checkbox" name="is_hostile" class="form-control" {{isset($creature) && $creature->is_hostile ? 'checked' : ''}}>
			</div>
			<label class="col-md-2 col-form-label text-md-right">Blocks Movement:</label>
			<div class="col-md-3">
				<input type="checkbox" name="is_blocking" class="form-control" {{isset($creature) && $creature->is_blocking ? 'checked' : ''}}>
			</div>
		</div>

		<h3>Spawn Rules:</h3>
		<div class="spawn-rules">
			<div class="spawn-forms" style="margin-left: 2rem;">
			@if (isset($creature) && $spawn_rules->count() > 0)
				@foreach ($spawn_rules as $spawn_rule)
				<input type="hidden" name="spawns[{{$spawn_rule->id}}][id]" value="{{$spawn_rule->id}}">
				<div class="form-group row">
					<label class="col-md-0 col-form-label text-md-right">Zone:</label>
					<div class="col-md-1">
						<input type="text" name="spawns[{{$spawn_rule->id}}][zone_id]" value="{{$spawn_rule->zones_id}}" class="form-control auto-lookup zone-lookup">
					</div>
					<label class="col-md-0 col-form-label text-md-right">Zone Area:</label>
					<div class="col-md-1">
						<input type="text" name="spawns[{{$spawn_rule->id}}][zone_areas_id]" value="{{$spawn_rule->zone_areas_id}}" class="form-control auto-lookup zone-area-lookup">
					</div>
					<label class="col-md-0 col-form-label text-md-right">Room:</label>
					<div class="col-md-1">
						@if ($spawn_rule->room())
						<input type="text" name="spawns[{{$spawn_rule->id}}][room_id]" value="{{$spawn_rule->rooms_id}}" class="form-control auto-lookup room-lookup">
						@else
						<input type="text" name="spawns[{{$spawn_rule->id}}][room_id]" class="form-control auto-lookup room-lookup">
						@endif
					</div>
					<label class="col-md-0 col-form-label text-md-right">Chance:</label>
					<div class="col-md-1">
						<input type="text" name="spawns[{{$spawn_rule->id}}][chance]" value="{{$spawn_rule->chance}}" class="form-control">
					</div>
				</div>
				@endforeach
			@endif
				<div class="form-group row">
					<label class="col-md-0 col-form-label text-md-right">Zone:</label>
					<div class="col-md-1">
						<input type="text" name="spawns[0][zone_id]" class="form-control auto-lookup zone-lookup">
					</div>
					<label class="col-md-0 col-form-label text-md-right">Zone Area:</label>
					<div class="col-md-1">
						<input type="text" name="spawns[0][zone_areas_id]" class="form-control auto-lookup zone-area-lookup">
					</div>
					<label class="col-md-0 col-form-label text-md-right">Room:</label>
					<div class="col-md-1">
						<input type="text" name="spawns[0][room_id]" class="form-control auto-lookup room-lookup">
					</div>
					<label class="col-md-0 col-form-label text-md-right">Chance:</label>
					<div class="col-md-1">
						<input type="text" name="spawns[0][chance]" class="form-control">
					</div>
				</div>
			
			</div>
		</div>

		<br>
		<a class="fa fa-plus" onclick="addSpawnRule(this);">Add Spawn Rule</a>

		<br><br>
		<h3>Loot Tables</h3>

		<div class="loot-tables">
			<div class="loot-forms">
			@if (isset($creature) && $loot_tables->count() > 0)
				@foreach ($loot_tables as $loot_table)
				<input type="hidden" name="loot_tables[{{$loot_table->id}}][id]" value="{{$loot_table->id}}">
				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">Item:</label>
					<div class="col-md-1">
						<input type="text" name="loot_tables[{{$loot_table->id}}][item_id]" value="{{$loot_table->items_id}}" class="form-control auto-lookup item-lookup">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Chance:</label>
					<div class="col-md-1">
						<input type="text" name="loot_tables[{{$loot_table->id}}][chance]" value="{{$loot_table->chance}}" class="form-control">
					</div>
				</div>
				@endforeach
			@endif
				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">Item:</label>
					<div class="col-md-1">
						<input type="text" name="loot_tables[0][item_id]" class="form-control auto-lookup item-lookup">
					</div>
					<label class="col-md-1 col-form-label text-md-right">Chance:</label>
					<div class="col-md-1">
						<input type="text" name="loot_tables[0][chance]" class="form-control">
					</div>
				</div>
			</div>
		</div>

		<br>
		<a class="fa fa-plus" onclick="addLootTable(this);">Add Loot Table</a>
		<br><br>

		@if (isset($creature))
		<input type="hidden" name="id" value="{{$creature->id}}">
		@endif
	</form>
</div>

<x-admin-nav title="{{ isset($creature) ? 'Editing a Creature' : 'Creating a Creature' }}" baseroute="creature" dbid="{{ isset($creature) ? $creature->id : 0}}"></x-admin-nav>

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

function addLootTable($btn)
	{
	var $tmp = $('.loot-forms > div').last().clone();
	// console.log($tmp.find('input').first().attr('name'));
	var matches = $tmp.find('input').first().attr('name').match(/loot_tables\[(\d*)\]/);
	
	var new_id = parseInt(matches[1]) + 1;

	$tmp.find('.form-control').each(function(i) {
		var name = $(this).attr('name').replace(/loot_tables\[\d*\]/, 'loot_tables['+new_id+']');
		$(this).attr('name', name);
		});

	$('.loot-forms').append($tmp);
	$('.loot-forms').last().find('input[name="id"]').remove();
	}
</script>

@endsection
