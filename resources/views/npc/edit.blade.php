@extends('layouts.admin')

@section('content')
Editing a NPC:<br>


	
<div>
	<form action="/npc/save" method="POST" class="form-horizontal ajax">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Name:</label>
			<div class="col-md-3">
				<input type="text" name="name" value="{{$npc->name}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Img Src:</label>
			<div class="col-md-3">
				<input type="text" name="img_src" value="{{$npc->img_src}}" class="form-control"><br>
			</div>
		</div>
		
		<input type="hidden" name="id" value="{{$npc->id}}">

		<div class="form-group row mb-0">
			<div class="col-md-2 offset-md-4">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>

	<h3>Stats:</h3>
	<form action="/npc/stats/save" method="POST" class="form-horizontal ajax">
		{{ csrf_field() }}
		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Health:</label>
			<div class="col-md-3">
				<input type="text" name="health" value="{{$stats->health}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Armor:</label>
			<div class="col-md-3">
				<input type="text" name="armor" value="{{$stats->armor}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Damage Min:</label>
			<div class="col-md-3">
				<input type="text" name="damage_low" value="{{$stats->damage_low}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Damage Max:</label>
			<div class="col-md-3">
				<input type="text" name="damage_high" value="{{$stats->damage_high}}" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-2 col-form-label text-md-right">Attacks:</label>
			<div class="col-md-3">
				<input type="text" name="attacks_per_round" value="{{$stats->attacks_per_round}}" class="form-control">
			</div>
		</div>
		
		<input type="hidden" name="id" value="{{$stats->id}}">

		<div class="form-group row mb-0">
			<div class="col-md-2 offset-md-4">
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</div>
	</form>

	<h3>Spawn Rules:</h3>
	@foreach ($spawn_rules as $spawn_rule)
		@if ($spawn_rule->zone())
			{{$spawn_rule->zone()->name}} @ {{$spawn_rule->chance * 100}}%<br>
		@endif

		@if ($spawn_rule->room())
			({{$spawn_rule->room()->id}}) {{$spawn_rule->room()->title}} @ {{$spawn_rule->chance * 100}}%<br>
		@endif
	@endforeach
	<br>
	<a class="fa fa-plus">Add Spawn Rule</a>
	<br><br>
	<h3>Loot Tables</h3>
	@foreach ($loot_tables as $loot_table)
		{{$loot_table->item()->name}} @ {{$loot_table->chance * 100}}%<br>
	@endforeach
	<br>
	<a class="fa fa-plus">Add Loot Table</a>
	<br><br>
</div>

<a href="/npc/all">Back</a>
<br><br>

@endsection
