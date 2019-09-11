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
			<div class="spawn-forms">
			@if (isset($creature) && $spawn_rules->count() > 0)
				@foreach ($spawn_rules as $spawn_rule)
				<input type="hidden" name="spawns[{{$spawn_rule->id}}][id]" value="{{$spawn_rule->id}}">
				<div class="form-group row">
					<label class="col-md-2 col-form-label text-md-right">Zone:</label>
					<div class="col-md-2">
						<select name="spawns[{{$spawn_rule->id}}][zone_id]" class="form-control">
							<option value="null">--None--</option>
							@foreach ($zones as $zone)
							@if ($spawn_rule->zone())
							<option value="{{$zone->id}}" {{$zone->id == $spawn_rule->zone()->id ? 'selected' : ''}}>({{$zone->id}}) {{$zone->name}}</option>
							@else
							<option value="{{$zone->id}}">({{$zone->id}}) {{$zone->name}}</option>
							@endif
							@endforeach
						</select>
					</div>
					<label class="col-md-2 col-form-label text-md-right">Room:</label>
					<div class="col-md-2">
						@if ($spawn_rule->room())
						<input type="text" name="spawns[{{$spawn_rule->id}}][room_id]" value="{{$spawn_rule->room()->id}}" class="form-control">
						@else
						<input type="text" name="spawns[{{$spawn_rule->id}}][room_id]" class="form-control">
						@endif
					</div>
					<label class="col-md-2 col-form-label text-md-right">Chance:</label>
					<div class="col-md-2">
						<input type="text" name="spawns[{{$spawn_rule->id}}][chance]" value="{{$spawn_rule->chance}}" class="form-control">
					</div>
				</div>
				@endforeach
			@endif
				<div class="form-group row">
					<label class="col-md-2 col-form-label text-md-right">Zone:</label>
					<div class="col-md-2">
						<select name="spawns[0][zone_id]" class="form-control">
							<option value="null">--None--</option>
							@foreach ($zones as $zone)
							<option value="{{$zone->id}}">({{$zone->id}}) {{$zone->name}}</option>
							@endforeach
						</select>
					</div>
					<label class="col-md-2 col-form-label text-md-right">Room:</label>
					<div class="col-md-2">
						<input type="text" name="spawns[0][room_id]" class="form-control">
					</div>
					<label class="col-md-2 col-form-label text-md-right">Chance:</label>
					<div class="col-md-2">
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
					<label class="col-md-2 col-form-label text-md-right">Item:</label>
					<div class="col-md-2">
						<select name="loot_tables[{{$loot_table->id}}][item_id]" class="form-control">
							<option value="null">--None--</option>
							@foreach ($items as $item)
							@if ($loot_table->item())
							<option value="{{$item->id}}" {{$item->id == $loot_table->item()->id ? 'selected' : ''}}>({{$item->id}}) {{$item->name}}</option>
							@else
							<option value="{{$item->id}}">({{$item->id}}) {{$item->name}}</option>
							@endif
							@endforeach
						</select>
					</div>
					<label class="col-md-2 col-form-label text-md-right">Chance:</label>
					<div class="col-md-2">
						<input type="text" name="loot_tables[{{$loot_table->id}}][chance]" value="{{$loot_table->chance}}" class="form-control">
					</div>
				</div>
				@endforeach
			@endif
				<div class="form-group row">
					<label class="col-md-2 col-form-label text-md-right">Item:</label>
					<div class="col-md-2">
						<select name="loot_tables[0][item_id]" class="form-control">
							<option value="null">--None--</option>
							@foreach ($items as $item)
							<option value="{{$item->id}}">({{$item->id}}) {{$item->name}}</option>
							@endforeach
						</select>
					</div>
					<label class="col-md-2 col-form-label text-md-right">Chance:</label>
					<div class="col-md-2">
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

		<div class="form-group row fixed-top" style="padding:.5rem;background-color:#555;border-bottom:2px solid white;">
			<div class="col-md-1">
				<a href="/admin" class="btn btn-info">Admin Home</a>
			</div>
			<div class="col-md-3 offset-md-1">
				<h3>
				@if (isset($zone))
				Editing a Creature:
				@else
				Creating a Creature:
				@endif
				</h3>
			</div>
			<div class="col-md-1">
				<a href="/creature/all" class="btn btn-secondary">Cancel</a>
			</div>
			<div class="col-md-1">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>
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
