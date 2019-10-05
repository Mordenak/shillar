@extends('layouts.admin')

@section('content')

<div class="form-group row fixed-top" style="padding:.5rem;background-color:#555;border-bottom:2px solid white;">
	<div class="col-md-1">
		<a href="/admin" class="btn btn-info">Admin Home</a>
	</div>
	<div class="col-md-3 offset-md-1">
		<h3>
		Creature Dump
		</h3>
	</div>
</div>

@foreach ($Creatures as $Creature)

['name' => '{{$Creature->name}}', 'attack_text' => "{{$Creature->attack_text}}", 'img_src' => '{{$Creature->img_src}}', 'is_hostile' => {{$Creature->is_hostile ? 'true' : 'false'}}, 'is_blocking' => {{$Creature->is_blocking ? 'true' : 'false'}}, 'alignments_id' => {{isset($Creature->alignments_id) ? $Creature->alignments_id : 'null'}}, 'alignment_strength' => {{isset($Creature->alignment_strength) ? $Creature->alignment_strength : 'null'}}, 'health' => {{$Creature->health}}, 'armor' => {{$Creature->armor}},  'magic_resistance' => {{$Creature->magic_resistance}}, 'scroll_resistance' => {{$Creature->scroll_resistance}}, 'damage_low' => {{$Creature->damage_low}}, 'damage_high' => {{$Creature->damage_high}}, 'attacks_per_round' => {{$Creature->attacks_per_round}}, 'award_xp' => {{$Creature->award_xp}}, 'xp_variation' => {{$Creature->xp_variation}}, 'award_gold' => {{$Creature->award_gold}}, 'gold_variation' => {{$Creature->gold_variation}}, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],<br>

@endforeach

<br><br><br>
<h2>CreatureGroups</h2>

@foreach ($CreatureGroups as $CreatureGroup)

['name' => '{{$CreatureGroup->name}}', 'description' => "{{$CreatureGroup->description}}", 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],<br>

@endforeach

<br><br><br>
<h2>SpawnRules</h2>

@foreach ($SpawnRules as $SpawnRule)

['creatures_id' => {{isset($SpawnRule->creatures_id) ? $SpawnRule->creatures_id : 'null'}}, 'creature_groups_id' => {{isset($SpawnRule->creature_groups_id) ? $SpawnRule->creature_groups_id : 'null'}}, 'zones_id' => {{isset($SpawnRule->zones_id) ? $SpawnRule->zones_id : 'null'}}, 'zone_level' => {{isset($SpawnRule->zone_level) ? $SpawnRule->zone_level : 'null'}}, zone_areas_id' => {{isset($SpawnRule->zone_areas_id) ? $SpawnRule->zone_areas_id : 'null'}}, 'rooms_id' => {{isset($SpawnRule->rooms_id) ? $SpawnRule->rooms_id : 'null'}}, 'chance' => {{isset($SpawnRule->chance) ? $SpawnRule->chance : 'null'}}, 'spawn_hour' => {{isset($SpawnRule->spawn_hour) ? $SpawnRule->spawn_hour : 'null'}}, 'random_hour' => {{$SpawnRule->random_hour ? 'true' : 'false'}}, 'priority' => {{isset($SpawnRule->priority) ? $SpawnRule->priority : 'null'}}, 'score_req' => {{isset($SpawnRule->score_req) ? $SpawnRule->score_req : 'null'}}, 'spawns_once' => {{$SpawnRule->spawns_once ? 'true' : 'false'}}, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],<br>

@endforeach

<br><br><br>
<h2>LootTables</h2>

@foreach ($LootTables as $LootTable)

['creatures_id' => {{$LootTable->creatures_id}}, 'items_id' => {{$LootTable->items_id}}, 'chance' => {{$LootTable->chance}}, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],<br>

@endforeach

@endsection
