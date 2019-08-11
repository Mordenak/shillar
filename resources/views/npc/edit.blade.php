@extends('layouts.admin')

@section('content')
Editing a NPC:<br>

<form action="/npc/save" method="POST" class="form-horizontal">
	{{ csrf_field() }}
	
	Name: <input type="text" name="name" value="{{$npc->name}}"><br>
	Img Src: <input type="text" name="img_src" value="{{$npc->img_src}}"><br>
	<input type="hidden" name="id" value="{{$npc->id}}">
	<input type="submit" value="Save!">
	<h3>Stats:</h3>
	Health: {{$stats->health}}<br>
	Damage Min: {{$stats->damage_low}}<br>
	Damage Max: {{$stats->damage_high}}<br>
	Attacks: {{$stats->attacks_per_round}}<br>
	<br><br>
	<h3>Spawn Rules:</h3>
	@foreach ($spawn_rules as $spawn_rule)
		@if ($spawn_rule->zone())
			{{$spawn_rule->zone()->name}} @ {{$spawn_rule->chance * 100}}%<br>
		@endif

		@if ($spawn_rule->room())
			{{$spawn_rule->room()->title}} @ {{$spawn_rule->chance * 100}}%<br>
		@endif
	@endforeach
	<br><br>
	<h3>Loot Tables</h3>
	@foreach ($loot_tables as $loot_table)
		{{$loot_table->item()->name}} @ {{$loot_table->chance * 100}}%<br>
	@endforeach
	<br><br>
</form>

<a href="/npc/all">Back</a>
<br><br>

@endsection