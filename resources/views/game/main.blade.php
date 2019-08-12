@extends('layouts.main')

@section('menu')
	<header>{{ $character->name }}, {{$character->playerrace->name}}</header>
	<ul>
		<li>XP: {{$character->xp}}</li>
		<li>Gold: {{$character->gold}}</li>
	</ul>
	<strong> -- Stats -- </strong>
	<ul>
		<li>Strength: {{$character->strength}}</li>
		<li>Dexterity: {{$character->dexterity}}</li>
		<li>Constitution: {{$character->constitution}}</li>
		<li>Wisdom: {{$character->wisdom}}</li>
		<li>Intelligence: {{$character->intelligence}}</li>
		<li>Charisma: {{$character->charisma}}</li>
		<br>
		<li>Score: {{$character->score}}</li>
		<!-- <li>Brute: {{$character->brute}}</li> -->
		<!-- <li>Finesse: {{$character->finesse}}</li> -->
		<!-- <li>Insight: {{$character->insight}}</li> -->
	</ul>
	<form method="post" action="/equipment" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<label for="equipment">Equipment</label>
		<input type="submit" id="equipment" style="display: none;">
	</form>
	<form method="post" action="/items" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<label for="items">Items</label>
		<input type="submit" id="items" style="display: none;">
	</form>
	<form method="post" action="/game" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<label for="back_home">Main</label>
		<input type="submit" id="back_home" style="display: none;">
	</form>
	

	<br><br>
	<form method="get" action="/home">
		{{csrf_field()}}
		<label for="char_select">Home</label>
		<input type="submit" id="char_select" style="display: none;">
	</form>
	<form method="post" action="/game" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<label for="back_home">Settings</label>
		<input type="submit" id="back_home" style="display: none;">
	</form>
@endsection

@section('main')
	@if (isset($combat_log))
	<p style="color: red;display: inline;">
	@foreach ($combat_log as $log_entry)
		{{$log_entry}}<br>
	@endforeach
	</p>
	@endif

	@if (isset($loot_log))
	<p style="display: inline;">
	@foreach ($loot_log as $log_entry)
		{{$log_entry}}<br>
	@endforeach
	</p>
	@endif

	<br>
	<div style="position: relative;">
	@if ($npc)
		<div style="display: inline-block;">
			<strong>{{ $npc->name }}</strong><br>
			@if ($npc->img_src)
			<img width="250" height="250" src="{{asset('img/'.$npc->img_src)}}">
			@else
			<img width="250" height="250" src="{{asset('img/unknown.jpg')}}">
			@endif
			<form method="post" action="/combat" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="room_id" value="{{$room->id}}">
				<input type="hidden" name="npc_id" value="{{$npc->id}}">
				<input type="hidden" name="character_id" value="{{$character->id}}">
				<!-- <label for="start_combat">All Out Attack</label> -->
				<!-- <label for="start_combat">Single Attack</label> -->
				<!-- <label for="start_combat">Run Away</label> -->
				<!-- <input type="submit" id="start_combat" style="display: none;"> -->
				@if (!$no_attack)
				<table>
					<tr>
						<td style="color:yellow;">
							All Out Attack<br>
							<input type="submit" id="all_out" value="{{$npc->name}}">
						</td>
						<td style="color:#55ff8b;">
							Single Attack<br>
							<input type="submit" id="single" value="{{$npc->name}}">
						</td>
						<td style="color:red;">
							Run Away<br>
							<input type="submit" id="flee" value="{{$npc->name}}">
						</td>
					</tr>
				</table>
				@else
				<span style="color:red;">You are too tired to attack</span>
				@endif
			</form>
		</div>
		<div style="display: inline-block;position:absolute;top:50%;transform: translateY(-50%);margin-left: .5rem;">
			Health: {{$character->health}} / {{$character->max_health}}<br>
			<progress value="{{$character->health}}" max="{{$character->max_health}}" class="stat-bar stat-bar-health {{ ($character->health <= ($character->max_health * .4)) ? '__low' : ''}}"></progress><br>
			Mana: {{$character->mana}} / {{$character->max_mana}}<br>
			<progress value="{{$character->mana}}" max="{{$character->max_mana}}" class="stat-bar stat-bar-mana"></progress><br>
			Fatigue: {{$character->fatigue}} / {{$character->max_fatigue}}<br>
			<progress value="{{$character->fatigue}}" max="{{$character->max_fatigue}}" class="stat-bar stat-bar-fatigue"></progress><br>
		</div>
	@else
		<div style="display: inline-block;margin-left: .5rem;">
			Health: {{$character->health}} / {{$character->max_health}}<br>
			<progress value="{{$character->health}}" max="{{$character->max_health}}" class="stat-bar stat-bar-health {{ ($character->health <= ($character->max_health * .4)) ? '__low' : ''}}"></progress><br>
			Mana: {{$character->mana}} / {{$character->max_mana}}<br>
			<progress value="{{$character->mana}}" max="{{$character->max_mana}}" class="stat-bar stat-bar-mana"></progress><br>
			Fatigue: {{$character->fatigue}} / {{$character->max_fatigue}}<br>
			<progress value="{{$character->fatigue}}" max="{{$character->max_fatigue}}" class="stat-bar stat-bar-fatigue"></progress><br>
		</div>
	@endif
	</div>
	

	<br>

	<!-- {{ $room->title }} -->

	<p>
		You are walking around in the {{ $room->zone()->first()->name }}
		<!-- {{ $room->description }} -->
	</p>

	
	<p>
		@if ($room->north_rooms_id)
			<form method="post" action="/move" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="room_id" value="{{$room->north_rooms_id}}">
				<input type="hidden" name="character_id" value="{{$character->id}}">
				You can travel <label for="move_north">north</label>
				<input type="submit" id="move_north" style="display: none;">
			</form>
		@endif

		@if ($room->east_rooms_id)
			<form method="post" action="/move" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="room_id" value="{{$room->east_rooms_id}}">
				<input type="hidden" name="character_id" value="{{$character->id}}">
				You can travel <label for="move_east">east</label>
				<input type="submit" id="move_east" style="display: none;">
			</form>
		@endif

		@if ($room->south_rooms_id)
			<form method="post" action="/move" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="room_id" value="{{$room->south_rooms_id}}">
				<input type="hidden" name="character_id" value="{{$character->id}}">
				You can travel <label for="move_south">south</label>
				<input type="submit" id="move_south" style="display: none;">
			</form>
		@endif

		@if ($room->west_rooms_id)
			<form method="post" action="/move" class="ajax">
				{{csrf_field()}}
				<input type="hidden" name="room_id" value="{{$room->west_rooms_id}}">
				<input type="hidden" name="character_id" value="{{$character->id}}">
				You can travel <label for="move_west">west</label>
				<input type="submit" id="move_west" style="display: none;">
			</form>
		@endif

	</p>
@endsection

@section('footer')
	A chat?
	<form method="post" action="/train" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<label for="begin_train">Train</label>
		<input type="submit" id="begin_train" style="display: none;">
	</form>

	<form method="post" action="/rest" class="ajax">
		{{csrf_field()}}
		<input type="hidden" name="character_id" value="{{$character->id}}">
		<label for="begin_rest">Rest</label>
		<input type="submit" id="begin_rest" style="display: none;">
	</form>
@endsection