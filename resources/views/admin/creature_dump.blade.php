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

['name' => '{{$Creature->name}}', 'attack_text' => "{{$Creature->attack_text}}", 'img_src' => '{{$Creature->img_src}}', 'is_hostile' => {{$Creature->is_hostile ? 'true' : 'false'}}, 'is_blocking' => {{$Creature->is_blocking ? 'true' : 'false'}}, 'alignments_id' => {{$Creature->alignments_id}}, 'alignment_strength' => {{$Creature->alignment_strength}}, 'health' => {{$Creature->health}}, 'armor' => {{$Creature->armor}},  'magic_resistance' => {{$Creature->magic_resistance}}, 'scroll_resistance' => {{$Creature->scroll_resistance}}, 'damage_low' => {{$Creature->damage_low}}, 'damage_high' => {{$Creature->damage_high}}, 'attacks_per_round' => {{$Creature->attacks_per_round}}, 'award_xp' => {{$Creature->award_xp}}, 'xp_variation' => {{$Creature->xp_variation}}, 'award_gold' => {{$Creature->award_gold}}, 'gold_variation' => {{$Creature->gold_variation}}, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],<br>

@endforeach

@endsection