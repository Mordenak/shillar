@extends('layouts.admin')

@section('content')
<h2>Editing NPC:</h2>
	
<div>
	<form action="/npc/save" method="POST" class="form-horizontal ajax">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{$npc->name}}" class="form-control">
			</div>
			<label class="col-md-2 col-form-label text-md-right">Img Src:</label>
			<div class="col-md-3">
				<input type="text" name="img_src" value="{{$npc->img_src}}" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Health:</label>
			<div class="col-md-3">
				<input type="text" name="health" value="{{$npc->health}}" class="form-control">
			</div>
			<label class="col-md-2 col-form-label text-md-right">Attack Text:</label>
			<div class="col-md-3">
				<input type="text" name="attack_text" value="{{$npc->attack_text}}" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Armor:</label>
			<div class="col-md-3">
				<input type="text" name="armor" value="{{$npc->armor}}" class="form-control">
			</div>

			<label class="col-md-2 col-form-label text-md-right">Award XP:</label>
			<div class="col-md-3">
				<input type="text" name="award_xp" value="{{$npc->award_xp}}" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Damage Min:</label>
			<div class="col-md-3">
				<input type="text" name="damage_low" value="{{$npc->damage_low}}" class="form-control">
			</div>
			<label class="col-md-2 col-form-label text-md-right">XP Variation:</label>
			<div class="col-md-3">
				<input type="text" name="xp_variation" value="{{$npc->xp_variation}}" placeholder="0.15" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Damage Max:</label>
			<div class="col-md-3">
				<input type="text" name="damage_high" value="{{$npc->damage_high}}" class="form-control">
			</div>
			<label class="col-md-2 col-form-label text-md-right">Award Gold:</label>
			<div class="col-md-3">
				<input type="text" name="award_gold" value="{{$npc->award_gold}}" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Attacks:</label>
			<div class="col-md-3">
				<input type="text" name="attacks_per_round" value="{{$npc->attacks_per_round}}" class="form-control">
			</div>
			<label class="col-md-2 col-form-label text-md-right">Gold Variation:</label>
			<div class="col-md-3">
				<input type="text" name="gold_variation" value="{{$npc->gold_variation}}" placeholder="0.15" class="form-control">
			</div>
		</div>



		<h3>Spawn Rules:</h3>
		<div class="spawn-rules">
			<div class="spawn-forms">
			@if ($spawn_rules->count() > 0)
				@foreach ($spawn_rules as $spawn_rule)
				<input type="hidden" name="id[spawns][]" value="{{$spawn_rule->id}}">
				<div class="form-group row">
					<div class="col">
						<label>Zone:</label>
						<select name="zone_id[spawns][]" class="form-control">
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
					<div class="col">
						<label>Room:</label>
						@if ($spawn_rule->room())
							<input type="text" name="room_id[spawns][]" value="{{$spawn_rule->room()->id}}" class="form-control">
						@else
							<input type="text" name="room_id[spawns][]" class="form-control">
						@endif
					</div>
					<div class="col">
						<label>Chance:</label>
						<input type="text" name="chance[spawns][]" value="{{$spawn_rule->chance}}" class="form-control">
					</div>
				</div>
				@endforeach
			@else
			<div class="form-group row">
				<div class="col">
					<label>Zone:</label>
					<select name="spawns[zone_id][]" class="form-control">
						<option value="null">--None--</option>
						@foreach ($zones as $zone)
						<option value="{{$zone->id}}">({{$zone->id}}) {{$zone->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label>Room:</label>
					<input type="text" name="spawns[room_id]" class="form-control">
				</div>
				<div class="col">
					<label>Chance:</label>
					<input type="text" name="spawns[chance]" class="form-control">
				</div>
			</div>
			@endif
			</div>
		</div>

		<br>
		<a class="fa fa-plus" onclick="addSpawnRule(this);">Add Spawn Rule</a>

		<br><br>
		<h3>Loot Tables</h3>

		<div class="loot-tables">
			<div class="loot-forms">
			@if ($loot_tables->count() > 0)
				@foreach ($loot_tables as $loot_table)
				<input type="hidden" name="loot_tables[id][]" value="{{$spawn_rule->id}}">
				<div class="form-group row">
					<div class="col">
						<label>Item:</label>
						<select name="loot_tables[item_id][]" class="form-control">
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
					<div class="col">
						<label>Chance:</label>
						<input type="text" name="loot_tables[chance][]" value="{{$loot_table->chance}}" class="form-control">
					</div>
				</div>
				@endforeach
			@else
				<div class="form-group row">
					<div class="col">
						<label>Item:</label>
						<select name="loot_tables[item_id][]" class="form-control">
							<option value="null">--None--</option>
							@foreach ($items as $item)
							<option value="{{$item->id}}">({{$item->id}}) {{$item->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="col">
						<label>Chance:</label>
						<input type="text" name="loot_tables[chance][]" class="form-control">
					</div>
				</div>
			@endif
			</div>
		</div>

		<br>
		<a class="fa fa-plus" onclick="addLootTable(this);">Add Loot Table</a>
		<br><br>

		<input type="hidden" name="id" value="{{$npc->id}}">

		<div class="form-group row mb-0">
			<div class="col-md-2 offset-md-4">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>

	<br><br>

</div>

<a href="/npc/all">Back</a>
<br><br>

<script>
function addSpawnRule($btn)
	{
	$('.spawn-rules').append($('.spawn-forms').last().clone());
	$('.spawn-forms').last().find('input[name="id"]').remove();
	}

function addLootTable($btn)
	{
	$('.loot-tables').append($('.loot-forms').last().clone());
	$('.loot-forms').last().find('input[name="id"]').remove();
	}
</script>

@endsection
